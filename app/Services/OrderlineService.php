<?php

namespace App\Services;

use App\Facades\EndeavourResponse;
use App\Models\Orderline;
use Exception;
use Illuminate\Http\JsonResponse;
use Log;

class OrderlineService
{
    public function getByBarcode(string $barcode, string $related, string $action): Orderline|JsonResponse
    {
        // If we have more than one orderline with the given barcode, we find the first record in the collection with a non-scanned print component.
        // This happens in the case of mugs where the ordered quantity >1 as the UUID is the barcode and multiple orderline records are created.
        $orderlines = Orderline::with($related)
            ->where('barcode', $barcode)
            ->get();
        Log::debug($orderlines);

        // handle barcode not found
        if ($orderlines->count() === 0) {
            return EndeavourResponse::notFound('Barcode not found');
        }

        // handle single line for this barcode
        if ($orderlines->count() === 1) {
            try {
                return $orderlines->first();
            } catch (Exception $e) {
                LogService::error(__CLASS__, __METHOD__, 'Unable to return first orderline', 32, $e->getMessage());
                return EndeavourResponse::notFound('Barcode not found');
            }
        }

        // handle multiple lines for this barcode, as in the case of mugs with original qty >1
        if ($orderlines->count() > 1) {
            $found_orderline = null;
            foreach ($orderlines as $line) {
                if (($action === 'print') && !$line->flag_all_components_scanned
                    && (
                        !$line->status == Orderline::STATUS_NAMES['in pigeonhole']
                        || !$line->status == Orderline::STATUS_NAMES['queued packing']
                        || !$line->pigeonhole_id
                    )) {
                    $found_orderline = $line;
                    break;
                }

                if (($action === 'pack') && !$line->flag_all_components_scanned
                    && (
                        !$line->status_id == Orderline::STATUS_NAMES['in pigeonhole']
                        || !$line->status_id == Orderline::STATUS_NAMES['queued packing']
                        || !$line->status_id == Orderline::STATUS_NAMES['packed complete']
                        || !$line->pigeonhole_id
                    )) {
                    $found_orderline = $line;
                    break;
                }

                if ($action === 'find') {
                    $found_orderline = $line;
                    break;
                }
            }

            if (!$found_orderline) {
                return EndeavourResponse::notFound('Barcode at required state not found');
            }
            return $found_orderline;
        }

        return EndeavourResponse::notFound('Unable to find barcode');
    }
}
