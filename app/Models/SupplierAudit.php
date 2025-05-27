<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierAudit extends Model
{
    protected $fillable = [
        'supplier_id',
        'audit_date',
        'auditor',
        'findings',
        'recommendations',
        'status',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
