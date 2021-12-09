<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderlineRequest;
use App\Models\Orderline;
use App\Services\OrderlineService;

class OrderlineController extends Controller
{
    protected OrderlineService $orderlineService;

    public function __construct(OrderlineService $orderlineService)
    {
        $this->orderlineService = $orderlineService;
    }

    public function index(): void
    {
        //
    }

    public function create(): void
    {
        //
    }

    public function store(OrderlineRequest $request): void
    {
        //
    }

    public function show(Orderline $orderline): void
    {
        //
    }

    public function edit(Orderline $orderline): void
    {
        //
    }

    public function update(OrderlineRequest $request, Orderline $orderline): void
    {
        // Do the updates
        $validated = $request->validated();

        // Remove this if the orderline already loads the order elsewhere in this method!
        $orderline->load('order');
    }

    public function destroy(Orderline $orderline): void
    {
        //
    }
}
