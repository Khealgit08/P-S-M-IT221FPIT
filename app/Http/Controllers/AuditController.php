<?php

namespace App\Http\Controllers;

use App\Models\SupplierAudit;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index()
    {
        $audits = SupplierAudit::with('supplier')->paginate(15);
        return response()->json($audits);
    }

    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required|exists:suppliers,id',
            'audit_date' => 'required|date',
            'auditor' => 'required|string',
            'findings' => 'required|string',
            'recommendations' => 'nullable|string',
            'status' => 'required|string',
        ]);
        try {
            SupplierAudit::create($request->all());
            return response()->json(['message' => 'Audit record created.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create audit record', 'details' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $audit = SupplierAudit::with('supplier')->findOrFail($id);
        return response()->json($audit);
    }

    public function edit($id)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'audit_date' => 'sometimes|required|date',
            'auditor' => 'sometimes|required|string',
            'findings' => 'sometimes|required|string',
            'recommendations' => 'nullable|string',
            'status' => 'sometimes|required|string',
        ]);
        try {
            $audit = SupplierAudit::findOrFail($id);
            $audit->update($request->all());
            return response()->json(['message' => 'Audit record updated.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update audit record', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $audit = SupplierAudit::findOrFail($id);
            $audit->delete();
            return response()->json(['message' => 'Audit record deleted.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete audit record', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Schedule next audit and track corrective actions.
     */
    public function scheduleNextAudit(Request $request, $id)
    {
        $this->validate($request, [
            'next_audit_date' => 'required|date',
            'corrective_actions' => 'nullable|string',
        ]);
        $audit = SupplierAudit::findOrFail($id);
        $audit->next_audit_date = $request->input('next_audit_date');
        $audit->corrective_actions = $request->input('corrective_actions');
        $audit->notification_sent = false;
        $audit->save();
        return response()->json(['message' => 'Next audit scheduled and corrective actions updated.']);
    }
}
