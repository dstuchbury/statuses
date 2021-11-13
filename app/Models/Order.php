<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public const STATUS_DESCRIPTIONS = [
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

    public function getStatus(): string
    {
        return $this::STATUS[$this->status];
    }

    public function setStatus($description): bool
    {
        try {
            $this->status = $this::STATUS_DESCRIPTIONS[$description];
            $this->save();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
