<?php

namespace App\Http\Controllers;

use App\Facades\EndeavourResponse;
use App\Services\OrderlineService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function scan(OrderlineService $orderlineService, Request $request): JsonResponse
    {
        // Find the orderline by barcode
        $orderline = $orderlineService->getByBarcode($request->input('barcode'), 'order', 'print');
        if ($orderline instanceof JsonResponse) {
            return $orderline;
        }

        if (! $request->input('machine_id')) {
            // In reality we would look for the machine to check it exists, then store it in $machine or return 404 as here.
            return EndeavourResponse::notFound(sprintf('Machine %s not found', $request->input('machine_id')));
        }

        if (! $orderline->isPrintable()) {
            return EndeavourResponse::notFound(sprintf('Orderline with barcode %s does not appear to require further prints', $request->input('barcode')));
        }

        return EndeavourResponse::ok(
            'Item marked scanned',
            'File exported to hot folder.',
            [
                'barcode' => $orderline->barcode,
                'orderline_ref' => $orderline->orderline_ref,
                'order_ref' => $orderline->order->order_ref,
                'sku_component' => 'sku component',
                'component_to_produce' => 'component to produce',
                'order_notes' => 'order notes',
                'orderline_notes' => 'orderline notes',
                'unprinted_components' => 'unprinted positions',
            ]
        );
    }
}
