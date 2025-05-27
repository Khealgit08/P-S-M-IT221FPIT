<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceiptNote;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class GoodsReceiptController extends Controller
{
    public function index()
    {
        $receipts = GoodsReceiptNote::with('purchaseOrder')->paginate(15);
        return response()->json($receipts);
    }

    public function show($id)
    {
        $receipt = GoodsReceiptNote::with('purchaseOrder')->findOrFail($id);
        return response()->json($receipt);
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
            'received_by' => 'required|string',
            'received_date' => 'required|date',
            'items' => 'required|string', // JSON or serialized
            'remarks' => 'nullable|string',
            'status' => 'required|string',
        ]);
        try {
            GoodsReceiptNote::create($request->all());
            return response()->json(['message' => 'Goods receipt note created.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create goods receipt note', 'details' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'purchase_order_id' => 'sometimes|required|exists:purchase_orders,id',
            'received_by' => 'sometimes|required|string',
            'received_date' => 'sometimes|required|date',
            'items' => 'sometimes|required|string',
            'remarks' => 'nullable|string',
            'status' => 'sometimes|required|string',
        ]);
        try {
            $receipt = GoodsReceiptNote::findOrFail($id);
            $receipt->update($request->all());
            return response()->json(['message' => 'Goods receipt note updated.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update goods receipt note', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $receipt = GoodsReceiptNote::findOrFail($id);
            $receipt->delete();
            return response()->json(['message' => 'Goods receipt note deleted.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete goods receipt note', 'details' => $e->getMessage()], 500);
        }
    }
}
