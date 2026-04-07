<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    public const PAYMENT_METHOD_COD = 'cod';

    public const PAYMENT_METHOD_BANK_TRANSFER = 'bank_transfer';

    protected $fillable = [
        'order_number',
        'user_id',
        'total_price',
        'status',
        'payment_method',
        'transfer_proof',
        'shipping_address',
    ];

    protected $casts = [
        'total_price' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function (Order $order): void {
            if (! empty($order->order_number)) {
                return;
            }

            $order->order_number = static::generateOrderNumber();
        });
    }

    protected static function generateOrderNumber(): string
    {
        // ULID is lexicographically sortable and collision-resistant.
        return 'ORD-'.now()->format('Ymd').'-'.Str::upper((string) Str::ulid());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
