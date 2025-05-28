<?php

namespace App\Http\Controllers;

use App\Models\SupplierCommunication;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierCommunicationController extends Controller
{
    public function index()
    {
        $communications = SupplierCommunication::with('supplier')->paginate(15);
        return response()->json($communications);
    }

    public function show($id)
    {
        $communication = SupplierCommunication::with('supplier')->findOrFail($id);
        return response()->json($communication);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required|exists:suppliers,id',
            'communication_date' => 'required|date',
            'type' => 'required|string',
            'subject' => 'required|string',
            'content' => 'required|string',
            'response' => 'nullable|string',
            'handled_by' => 'nullable|string',
        ]);
        try {
            $communication = SupplierCommunication::create($request->all());
            return response()->json(['message' => 'Supplier communication added.', 'data' => $communication], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add supplier communication', 'details' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'communication_date' => 'sometimes|required|date',
            'type' => 'sometimes|required|string',
            'subject' => 'sometimes|required|string',
            'content' => 'sometimes|required|string',
            'response' => 'nullable|string',
            'handled_by' => 'nullable|string',
        ]);
        try {
            $communication = SupplierCommunication::findOrFail($id);
            $communication->update($request->all());
            return response()->json(['message' => 'Supplier communication updated.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update supplier communication', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $communication = SupplierCommunication::findOrFail($id);
            $communication->delete();
            return response()->json(['message' => 'Supplier communication deleted.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete supplier communication', 'details' => $e->getMessage()], 500);
        }
    }
}
