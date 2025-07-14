<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BreastMilk;
use App\Models\User;

class BreastMilkController extends Controller
{
    public function index(Request $request)
{
    $query = BreastMilk::with('requester');

    // Filters
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('phone')) {
        $query->where('phone', 'like', '%' . $request->phone . '%');
    }

    if ($request->filled('location')) {
        $query->where('location', 'like', '%' . $request->location . '%');
    }

    if ($request->filled('milk_quantity')) {
        $query->where('milk_quantity', $request->milk_quantity);
    }

    if ($request->filled('milk_type')) {
        $query->where('milk_type', $request->milk_type);
    }

    if ($request->filled('milk_for')) {
        $query->where('milk_for', $request->milk_for);
    }

    if ($request->filled('requester')) {
        $query->whereHas('requester', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->requester . '%');
        });
    }

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
    }

    $records = $query->latest()->get();

    return view('admin.breastmilk.index', compact('records'));
}


    public function create()
    {
        $users = User::select('id', 'name')->get();
        return view('admin.breastmilk.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'requester_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'phone' => 'required|string',
            'location' => 'required|string',
            'milk_quantity' => 'required|numeric',
            'milk_type' => 'required|string',
            'milk_for' => 'required|integer',
        ]);
    
        $validated['status'] = 'requested';
    
        BreastMilk::create($validated);

        return redirect()->route('breastmilk.index')->with('success', 'Breast milk request added successfully.');
    }

    public function show(BreastMilk $breastmilk)
    {
        return view('admin.breastmilk.show', compact('breastmilk'));
    }
    public function edit(BreastMilk $breastmilk)
    {
        $users = User::select('id', 'name')->get();
        return view('admin.breastmilk.edit', compact('breastmilk', 'users'));
    }
    public function update(Request $request, BreastMilk $breastmilk)
    {
        $validated = $request->validate([
            'requester_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'phone' => 'required|string',
            'location' => 'required|string',
            'milk_quantity' => 'required|numeric',
            'milk_type' => 'required|string',
            'milk_for' => 'required|integer',
        ]);
    
        $breastmilk->update($validated);

        return redirect()->route('breastmilk.index')->with('success', 'Breast milk request updated successfully.');
    }

    public function destroy(BreastMilk $breastmilk)
    {
        $breastmilk->delete();
        return redirect()->route('breastmilk.index')->with('success', 'Request deleted successfully.');
    }
}
