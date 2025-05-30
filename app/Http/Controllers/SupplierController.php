<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierClassification;
use App\Models\SupplierPerformance;
use App\Models\SupplierCommunication;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate(15);
        return response()->json($suppliers);
    }

    public function show($id)
    {
        $supplier = Supplier::with(['classifications', 'performances', 'communications'])->findOrFail($id);
        return response()->json($supplier);
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
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|string|max:50',
            'address' => 'required|string',
            'status' => 'required|string',
        ]);
        try {
            Supplier::create($request->all());
            return response()->json(['message' => 'Supplier added.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add supplier', 'details' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'sometimes|required|string|max:255',
            'contact_person' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:suppliers,email,' . $id,
            'phone' => 'sometimes|required|string|max:50',
            'address' => 'sometimes|required|string',
            'status' => 'sometimes|required|string',
        ]);
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->update($request->all());
            return response()->json(['message' => 'Supplier updated.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update supplier', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();
            return response()->json(['message' => 'Supplier deleted.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete supplier', 'details' => $e->getMessage()], 500);
        }
    }

    public function updateCompliance(Request $request, $id)
    {
        $this->validate($request, [
            'certification' => 'sometimes|string',
            'certification_expiry' => 'sometimes|date',
            'compliance_status' => 'sometimes|boolean',
        ]);
        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->only(['certification', 'certification_expiry', 'compliance_status']));
        return response()->json(['message' => 'Supplier compliance updated.']);
    }

    /**
     * Exception reporting for suppliers (e.g., blacklisted, non-compliant).
     */
    public function exceptions()
    {
        $suppliers = Supplier::where('status', 'blacklisted')
            ->orWhere('compliance_status', false)
            ->get();
        return response()->json(['exceptions' => $suppliers]);
    }

    /**
     * Cost efficiency analysis for suppliers.
     */
    public function costEfficiency()
    {
        $suppliers = Supplier::with(['performances'])->get();
        $result = $suppliers->map(function($supplier) {
            $avgCost = $supplier->performances->avg('cost_score');
            return [
                'supplier_id' => $supplier->id,
                'name' => $supplier->name,
                'average_cost_score' => $avgCost,
            ];
        });
        return response()->json(['cost_efficiency' => $result]);
    }
}
