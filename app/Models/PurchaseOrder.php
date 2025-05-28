<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'supplier_id',
        'order_date',
        'items',
        'status',
        'approval_status',
        'approved_by',
        'approved_at',
        'rejected_reason',
        'discrepancy_flag',
        'discrepancy_details',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function goodsReceiptNotes()
    {
        return $this->hasMany(GoodsReceiptNote::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Automatically calculate total_amount from items
    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            if ($model->items) {
                $items = is_array($model->items) ? $model->items : json_decode($model->items, true);
                $total = 0;
                foreach ($items as $item) {
                    $qty = isset($item['quantity']) ? $item['quantity'] : 0;
                    $price = isset($item['price']) ? $item['price'] : 0;
                    $total += $qty * $price;
                }
                $model->total_amount = $total;
            }
        });
    }

    // Normalize items structure for data integrity
    public function setItemsAttribute($value)
    {
        if (is_string($value)) {
            $items = json_decode($value, true);
        } else {
            $items = $value;
        }
        // Normalize: ensure each item has item, quantity, price
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
