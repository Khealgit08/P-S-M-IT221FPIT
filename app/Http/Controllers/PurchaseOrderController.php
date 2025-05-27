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
            'total_amount' => 'required|numeric|min:0',
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
        $order = PurchaseOrder::with('supplier')->findOrFail($id);
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
            'total_amount' => 'sometimes|required|numeric|min:0',
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
}
