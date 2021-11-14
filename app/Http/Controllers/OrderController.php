<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderService $orderService;

    /**
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        // The OrderService is injected by the Service Container, with zero config required.
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

    public function store(OrderRequest $request)
    {

    }

    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(OrderRequest $request, Order $order)
    {
        // Do whatever updating is required.
        $validated = $request->validated();

        // Call a method in our service class.
        $this->orderService->recalculatePrices($order);
    }

    public function destroy(Order $order)
    {
        //
    }
}
