<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $orders = PurchaseOrder::with('supplier')->paginate(15);
        return response()->json($orders);
    }

    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'items' => 'required|string', // JSON or serialized
            'status' => 'required|string',
        ]);
        try {
            PurchaseOrder::create($request->all());
            return response()->json(['message' => 'Purchase order created.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create purchase order', 'details' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $order = PurchaseOrder::with(['supplier', 'approver'])->findOrFail($id);
        return response()->json($order);
    }

    public function edit($id)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'order_date' => 'sometimes|required|date',
            'items' => 'sometimes|required|string',
            'status' => 'sometimes|required|string',
        ]);
        try {
            $order = PurchaseOrder::findOrFail($id);
            $order->update($request->all());
            return response()->json(['message' => 'Purchase order updated.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update purchase order', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $order = PurchaseOrder::findOrFail($id);
            $order->delete();
            return response()->json(['message' => 'Purchase order deleted.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete purchase order', 'details' => $e->getMessage()], 500);
        }
    }

    public function approve(Request $request, $id)
    {
        $this->validate($request, [
            'approved_by' => 'required|exists:users,id',
        ]);
        $order = PurchaseOrder::findOrFail($id);
        if ($order->approval_status !== 'pending') {
            return response()->json(['error' => 'Order already processed.'], 400);
        }
        $order->approval_status = 'approved';
        $order->approved_by = $request->input('approved_by');
        $order->approved_at = \Carbon\Carbon::now();
        $order->rejected_reason = null;
        $order->save();
        return response()->json(['message' => 'Purchase order approved.']);
    }

    public function reject(Request $request, $id)
    {
        $this->validate($request, [
            'approved_by' => 'required|exists:users,id',
            'rejected_reason' => 'required|string',
        ]);
        $order = PurchaseOrder::findOrFail($id);
        if ($order->approval_status !== 'pending') {
            return response()->json(['error' => 'Order already processed.'], 400);
        }
        $order->approval_status = 'rejected';
        $order->approved_by = $request->input('approved_by');
        $order->approved_at = \Carbon\Carbon::now();
        $order->rejected_reason = $request->input('rejected_reason');
        $order->save();
        return response()->json(['message' => 'Purchase order rejected.']);
    }

    /**
     * Perform three-way matching for a purchase order.
     * Compares PO, GRN, and Invoice and flags discrepancies.
     */
    public function match($id)
    {
        $order = PurchaseOrder::with(['goodsReceiptNotes', 'invoices'])->findOrFail($id);
        $poItems = is_array($order->items) ? collect($order->items) : collect(json_decode($order->items, true));
        $grnItems = $order->goodsReceiptNotes->flatMap(function($grn) {
            $items = is_array($grn->items) ? $grn->items : json_decode($grn->items, true);
            return collect($items);
        });
        $invoiceItems = $order->invoices->flatMap(function($inv) use ($order) {
            // For simplicity, assume invoice amount is for all items
            return collect([['amount' => $inv->amount]]);
        });
        $discrepancies = [];
        // Check quantities and items
        foreach ($poItems as $item) {
            $grnQty = $grnItems->where('item', $item['item'])->sum('quantity');
            if ($grnQty != $item['quantity']) {
                $discrepancies[] = "Item {$item['item']} quantity mismatch: PO={$item['quantity']}, GRN={$grnQty}";
            }
        }
        // Check total amount
        $poTotal = $order->total_amount;
        $invoiceTotal = $order->invoices->sum('amount');
        if ($poTotal != $invoiceTotal) {
            $discrepancies[] = "Total amount mismatch: PO={$poTotal}, Invoice={$invoiceTotal}";
        }
        $order->discrepancy_flag = count($discrepancies) > 0;
        $order->discrepancy_details = count($discrepancies) ? implode("; ", $discrepancies) : null;
        $order->save();
        return response()->json([
            'discrepancy_flag' => $order->discrepancy_flag,
            'discrepancy_details' => $order->discrepancy_details,
        ]);
    }
}
