<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::query()->get();
        return view('deliveries.index', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('deliveries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliveryRequest $request)
    {
        $data = $request->except('_token');
        Delivery::create($data);

        session(['message' => 'Delivery created successfully']);

        return redirect()->route('deliveries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delivery $delivery)
    {
        return view('deliveries.edit', compact('delivery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliveryRequest $request, Delivery $delivery)
    {
        $data = $request->except('_token');
        $delivery->update($data);

        session(['message' => 'Delivery updated successfully']);

        return redirect()->route('deliveries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        session(['message' => 'Delivery deleted successfully']);
        return redirect()->route('deliveries.index');
    }
}
