<?php

namespace App\Http\Controllers;

use App\Models\SupplierPerformance;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierPerformanceController extends Controller
{
    public function index()
    {
        $performances = SupplierPerformance::with('supplier')->paginate(15);
        return response()->json($performances);
    }

    public function show($id)
    {
        $performance = SupplierPerformance::with('supplier')->findOrFail($id);
        return response()->json($performance);
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
            'supplier_id' => 'required|exists:suppliers,id',
            'evaluation_date' => 'required|date',
            'quality_score' => 'required|numeric|min:0|max:100',
            'delivery_score' => 'required|numeric|min:0|max:100',
            'cost_score' => 'required|numeric|min:0|max:100',
            'compliance_score' => 'required|numeric|min:0|max:100',
            'overall_score' => 'required|numeric|min:0|max:100',
            'comments' => 'nullable|string',
        ]);
        try {
            SupplierPerformance::create($request->all());
            return response()->json(['message' => 'Performance record added.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add performance record', 'details' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'evaluation_date' => 'sometimes|required|date',
            'quality_score' => 'sometimes|required|numeric|min:0|max:100',
            'delivery_score' => 'sometimes|required|numeric|min:0|max:100',
            'cost_score' => 'sometimes|required|numeric|min:0|max:100',
            'compliance_score' => 'sometimes|required|numeric|min:0|max:100',
            'overall_score' => 'sometimes|required|numeric|min:0|max:100',
            'comments' => 'nullable|string',
        ]);
        try {
            $performance = SupplierPerformance::findOrFail($id);
            $performance->update($request->all());
            return response()->json(['message' => 'Performance record updated.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update performance record', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $performance = SupplierPerformance::findOrFail($id);
            $performance->delete();
            return response()->json(['message' => 'Performance record deleted.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete performance record', 'details' => $e->getMessage()], 500);
        }
    }
}
