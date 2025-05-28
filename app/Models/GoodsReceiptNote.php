<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsReceiptNote extends Model
{
    protected $fillable = [
        'purchase_order_id',
        'received_by',
        'received_date',
        'items', // JSON or serialized
        'remarks',
        'status',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    // Optionally, auto-calculate total_received_amount from items
    public function getTotalReceivedAmountAttribute()
    {
        $items = is_array($this->items) ? $this->items : json_decode($this->items, true);
        $total = 0;
        if (is_array($items)) {
            foreach ($items as $item) {
                $qty = isset($item['quantity']) ? $item['quantity'] : 0;
                $price = isset($item['price']) ? $item['price'] : 0;
                $total += $qty * $price;
            }
        }
        return $total;
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function setItemsAttribute($value)
    {
        if (is_string($value)) {
            $items = json_decode($value, true);
        } else {
            $items = $value;
        }
        $normalized = [];
        foreach ($items as $item) {
            $normalized[] = [
                'item' => $item['item'] ?? '',
                'quantity' => (int)($item['quantity'] ?? 0),
                'price' => (float)($item['price'] ?? 0),
            ];
        }
        $this->attributes['items'] = json_encode($normalized);
    }
}
