<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderlineRequest;
use App\Models\Orderline;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderlineController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(OrderlineRequest $request)
    {
        //
    }

    public function show(Orderline $orderline)
    {
        //
    }

    public function edit(Orderline $orderline)
    {
        //
    }

    public function update(OrderlineRequest $request, Orderline $orderline)
    {
        // Do the updates
        $validated = $request->validated();

        // Remove this if the orderline already loads the order elsewhere in this method!
        $orderline->load('order');

        // Update the order prices
        $this->orderService->recalculatePrices($orderline->order);
    }

    public function destroy(Orderline $orderline)
    {
        //
    }
}
