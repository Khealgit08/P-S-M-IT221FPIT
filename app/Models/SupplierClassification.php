<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierClassification extends Model
{
    protected $fillable = [
        'supplier_id',
        'classification',
        'criteria',
        'assigned_by',
        'assigned_at',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
