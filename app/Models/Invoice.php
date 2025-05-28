<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'purchase_order_id',
        'invoice_date',
        'amount',
        'status',
    ];

    // Automatically calculate amount from related PO if not provided
    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            if (empty($model->amount) && $model->purchase_order_id) {
                $po = \App\Models\PurchaseOrder::find($model->purchase_order_id);
                if ($po) {
                    $model->amount = $po->total_amount;
                }
            }
        });
    }

    // Normalize amount to float for accuracy
    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = (float)$value;
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
}
