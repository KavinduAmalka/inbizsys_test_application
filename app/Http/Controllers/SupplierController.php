<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Step 1: Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        // Step 2: Create the supplier in database
        Supplier::create($validated);

        // Step 3: Redirect with success message
        return redirect()->route('suppliers.index')
                        ->with('success', 'Supplier created successfully!');
    }

    /**
     * Show the form for editing a supplier.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Step 1: Find the supplier by ID
        $supplier = Supplier::findOrFail($id);

        // Step 2: Show the edit form with supplier data
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the supplier in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Step 1: Find the supplier
        $supplier = Supplier::findOrFail($id);

        // Step 2: Validate the incoming data
        // Important: When updating, we need to ignore the current supplier's email
        // so that the unique validation doesn't fail on the same email
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        // Step 3: Update the supplier with new data
        $supplier->update($validated);

        // Step 4: Redirect with success message
        return redirect()->route('suppliers.index')
                        ->with('success', 'Supplier updated successfully!');
    }

    /**
     * Delete a supplier from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Step 1: Find the supplier
        $supplier = Supplier::findOrFail($id);

        // Step 2: Delete the supplier
        $supplier->delete();

        // Step 3: Redirect with success message
        return redirect()->route('suppliers.index')
                        ->with('success', 'Supplier deleted successfully!');
    }

    /**
     * Display the print-friendly view for all suppliers.
     *
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        $suppliers = Supplier::all();
        return view('suppliers.print', compact('suppliers'));
    }
}
