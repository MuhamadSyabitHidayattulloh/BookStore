<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const PAYMENT_METHOD_COD = 'cod';

    public const PAYMENT_METHOD_BANK_TRANSFER = 'bank_transfer';

    public const SHIPPING_FEE = 20000;

    public const FREE_SHIPPING_MINIMUM = 100000;

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
        $datePart = now()->format('Ymd');
        $prefix = 'ORD-'.$datePart.'-';

        // Keep order numbers human-readable: date + daily sequence.
        $lastToday = static::query()
            ->where('order_number', 'like', $prefix.'%')
            ->whereDate('created_at', now()->toDateString())
            ->lockForUpdate()
            ->orderByDesc('id')
            ->value('order_number');

        $nextSequence = 1;
        if ($lastToday) {
            $lastSequence = (int) substr((string) $lastToday, -4);
            $nextSequence = $lastSequence + 1;
        }

        return $prefix.str_pad((string) $nextSequence, 4, '0', STR_PAD_LEFT);
    }

    public static function calculateShippingFee(int $subtotal): int
    {
        return $subtotal > static::FREE_SHIPPING_MINIMUM ? 0 : static::SHIPPING_FEE;
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
