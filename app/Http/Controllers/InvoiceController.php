<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('purchaseOrder')->paginate(15);
        return response()->json($invoices);
    }

    public function show($id)
    {
        $invoice = Invoice::with('purchaseOrder')->findOrFail($id);
        return response()->json($invoice);
    }

    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function edit($id)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'invoice_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);
        try {
            Invoice::create($request->all());
            return response()->json(['message' => 'Invoice created.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create invoice', 'details' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'purchase_order_id' => 'sometimes|required|exists:purchase_orders,id',
            'invoice_date' => 'sometimes|required|date',
            'amount' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|required|string',
        ]);
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->update($request->all());
            return response()->json(['message' => 'Invoice updated.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update invoice', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->delete();
            return response()->json(['message' => 'Invoice deleted.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete invoice', 'details' => $e->getMessage()], 500);
        }
    }
}
