<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with('supplier')->paginate(15);
        return response()->json($contracts);
    }

    public function show($id)
    {
        $contract = Contract::with('supplier')->findOrFail($id);
        return response()->json($contract);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required|exists:suppliers,id',
            'title' => 'required|string',
            'terms' => 'required|string',
            'sla' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'payment_terms' => 'required|string',
            'discount_terms' => 'nullable|string',
            'status' => 'required|string',
        ]);
        try {
            $contract = Contract::create($request->all());
            return response()->json(['message' => 'Contract created.', 'data' => $contract], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create contract', 'details' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'title' => 'sometimes|required|string',
            'terms' => 'sometimes|required|string',
            'sla' => 'nullable|string',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after_or_equal:start_date',
            'payment_terms' => 'sometimes|required|string',
            'discount_terms' => 'nullable|string',
            'status' => 'sometimes|required|string',
        ]);
        try {
            $contract = Contract::findOrFail($id);
            $contract->update($request->all());
            return response()->json(['message' => 'Contract updated.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update contract', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $contract = Contract::findOrFail($id);
            $contract->delete();
            return response()->json(['message' => 'Contract deleted.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete contract', 'details' => $e->getMessage()], 500);
        }
    }

    /**
     * Check and alert for payment due/discount opportunities.
     */
    public function checkPaymentAlerts()
    {
        $contracts = Contract::where('payment_due_date', '<=', now()->addDays(7))
            ->where('payment_alert_sent', false)
            ->get();
        foreach ($contracts as $contract) {
            // Here you would send an alert/notification (email, etc.)
            $contract->payment_alert_sent = true;
            $contract->save();
        }
        return response()->json(['message' => 'Payment alerts processed.', 'count' => $contracts->count()]);
    }
}
