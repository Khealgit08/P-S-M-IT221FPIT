<?php

namespace App\Http\Controllers;

use App\Models\SupplierClassification;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierClassificationController extends Controller
{
    public function index()
    {
        $classifications = SupplierClassification::with('supplier')->paginate(15);
        return response()->json($classifications);
    }

    public function show($id)
    {
        $classification = SupplierClassification::with('supplier')->findOrFail($id);
        return response()->json($classification);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required|exists:suppliers,id',
            'classification' => 'required|string',
            'criteria' => 'nullable|string',
            'assigned_by' => 'nullable|string',
            'assigned_at' => 'nullable|date',
        ]);
        try {
            $classification = SupplierClassification::create($request->all());
            return response()->json(['message' => 'Supplier classification added.', 'data' => $classification], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add supplier classification', 'details' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'classification' => 'sometimes|required|string',
            'criteria' => 'nullable|string',
            'assigned_by' => 'nullable|string',
            'assigned_at' => 'nullable|date',
        ]);
        try {
            $classification = SupplierClassification::findOrFail($id);
            $classification->update($request->all());
            return response()->json(['message' => 'Supplier classification updated.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update supplier classification', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $classification = SupplierClassification::findOrFail($id);
            $classification->delete();
            return response()->json(['message' => 'Supplier classification deleted.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete supplier classification', 'details' => $e->getMessage()], 500);
        }
    }
}
