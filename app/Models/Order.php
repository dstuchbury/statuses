<?php

namespace App\Models;

use Database\Factories\OrderFactory;
use Eloquent;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $status
 * @property string $order_ref
 * @property string $date_received
 * @property string $date_sla
 * @property string $price_total_net
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Orderline[] $orderlines
 * @property-read int|null $orderlines_count
 * @method static OrderFactory factory(...$parameters)
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDateReceived($value)
 * @method static Builder|Order whereDateSla($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereOrderRef($value)
 * @method static Builder|Order wherePriceTotalNet($value)
 * @method static Builder|Order whereStatus($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'order_ref',
        'date_received',
        'date_sla'
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

    // Relationships
    public function orderlines(): hasMany
    {
        return $this->hasMany(Orderline::class);
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
