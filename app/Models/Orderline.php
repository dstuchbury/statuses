<?php

namespace App\Models;

use Database\Factories\OrderlineFactory;
use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * App\Models\Orderline
 *
 * @property int $id
 * @property int $order_id
 * @property int $status
 * @property int $quantity
 * @property string $price_unit
 * @property string $price_total
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Order $order
 * @method static OrderlineFactory factory(...$parameters)
 * @method static Builder|Orderline newModelQuery()
 * @method static Builder|Orderline newQuery()
 * @method static Builder|Orderline query()
 * @method static Builder|Orderline whereCreatedAt($value)
 * @method static Builder|Orderline whereId($value)
 * @method static Builder|Orderline whereOrderId($value)
 * @method static Builder|Orderline wherePriceTotal($value)
 * @method static Builder|Orderline wherePriceUnit($value)
 * @method static Builder|Orderline whereQuantity($value)
 * @method static Builder|Orderline whereStatus($value)
 * @method static Builder|Orderline whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Orderline extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'price_unit',
        'quantity',
        'status',
    ];

    public const STATUS = [
        1 => 'new',
        2 => 'queued downloading',
        3 => 'downloaded',
        4 => 'queued processing',
        5 => 'processed',
        6 => 'ready',
        7 => 'production released',
        8 => 'in production',
        9 => 'queued packing',
        10 => 'queued qc',
        11 => 'qc approved',
        12 => 'in pigeonhole',
        13 => 'packed complete',
        14 => 'ready to ship',
        15 => 'shipped',
        16 => 'address issue',
        17 => 'artwork issue',
        18 => 'queued reprint'
    ];

    public const STATUS_NAMES = [
        'new' => 1,
        'queued downloading' => 2,
        'downloaded' => 3,
        'queued processing' => 4,
        'processed' => 5,
        'ready' => 6,
        'production released' => 7,
        'in production' => 8,
        'queued packing' => 9,
        'queued qc' => 10,
        'qc approved' => 11,
        'in pigeonhole' => 12,
        'packed complete' => 13,
        'ready to ship' => 14,
        'shipped' => 15,
        'address issue' => 16,
        'artwork issue' => 17,
        'queued reprint' => 18
    ];

    // relationships
    public function order(): belongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getStatus(): string
    {
        return $this::STATUS[$this->status];
    }

    public function setStatus($description): bool
    {
        try {
            DB::transaction(function() use ($description) {
                $this->status = $this::STATUS_NAMES[$description];
                $this->save();
            }, 5);
        } catch (Exception | Throwable $e) {
            return false;
        }

        return true;
    }
}
