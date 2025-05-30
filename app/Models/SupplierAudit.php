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
        'next_audit_date',
        'notification_sent',
        'corrective_actions',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
