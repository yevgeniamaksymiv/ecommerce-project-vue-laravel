<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrdersInPeriodRequest;
use App\Http\Requests\StoreOrderStatusRequest;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query()->get();
        return view('orders.index', compact('orders'));
    }

    public function export(Request $request)
    {
        if ($request->has('startDate') && $request->has('endDate')) {
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate') . ' 23:59:59';

            $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();

            return Excel::download(new OrdersExport($orders), 'orders.xlsx');
        }

        return Excel::download(new OrdersExport, 'orders.xlsx');
    }

    public function ordersInPeriod(OrdersInPeriodRequest $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate') . ' 23:59:59';

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();
        $ordersCount = $orders->count();

        return view('orders.index',  compact('orders', 'startDate', 'endDate', 'ordersCount'));
    }

    public function generatePdf(Request $request)
    {
        if ($request->has('startDate') && $request->has('endDate')) {
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate') . ' 23:59:59';

            $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();

            $pdf = PDF::loadView('orders.pdf', compact('orders','startDate', 'endDate'));

            return $pdf->download('orders.pdf');
        }
            $orders = Order::query()->get();

            $pdf = PDF::loadView('orders.pdf', compact('orders'));

            return $pdf->download('orders.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $statuses = ['pending', 'delivery', 'completed'];
        return view('orders.edit', compact('order', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrderStatusRequest $request, Order $order)
    {
        $data = $request->only('status');

        $order->status = $data['status'];
        $order->save();

        session(['message' => 'Order updated successfully']);

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->products()->detach();
        $order->delete();

        session(['message' => 'Order deleted successfully']);

        return redirect()->route('orders.index');
    }

    public function restore(Order $order)
    {
        $order->restore();
        foreach ($order->products as $product) {
            $order->products()->attach($product->id);
        }

        session(['message' => 'Order restored successfully']);

        return redirect()->route('orders.index');
    }

}
