<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Jobs\CreateOrderPdfJob;
use App\Jobs\SendOrderEmailJob;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreatedEmail;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate();
        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('products');
        $data['status'] = 'new';
        $products = $request->get('products');
        $order = Order::create($data);
        $order->products()->sync($products);
        SendOrderEmailJob::dispatch($order);

        return new OrderResource($order);
    }

    public function createOrderPdf(Request $request)
    {
        $order_id = $request->get('order_id');
        $order = Order::where('id', $order_id)->first();
        CreateOrderPdfJob::dispatch($order);

        return response(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }
}
