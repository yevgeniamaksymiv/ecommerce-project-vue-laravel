<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrdersInPeriodRequest;
use App\Http\Requests\StoreOrderStatusRequest;
use App\Models\Order;
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

    public function export()
    {
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
}
