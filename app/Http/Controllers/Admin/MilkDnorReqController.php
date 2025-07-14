<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MilkDonorReqValidation;

class MilkDnorReqController extends Controller
{
   public function index(Request $request)
{
   $query = MilkDonorReqValidation::with(['donor', 'breastMilk']);

// Filter by Donor Name (text-based)
if ($request->filled('donor_id')) {
    $query->whereHas('donor', function ($q) use ($request) {
        $q->where('name', 'like', '%' . $request->donor_id . '%');
    });
}

// Filter by Breast Milk Name (text-based)
if ($request->filled('breast_milk_id')) {
    $query->whereHas('breastMilk', function ($q) use ($request) {
        $q->where('name', 'like', '%' . $request->breast_milk_id . '%');
    });
}

    // Filter: Is Verified
    if ($request->filled('is_verified')) {
        $query->where('is_verified', $request->is_verified);
    }

    // Filter: Date range
    if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('created_at', [
            $request->from_date . ' 00:00:00',
            $request->to_date . ' 23:59:59',
        ]);
    }

    $milkdonors = $query->latest()->get();

    // Optional: Fetch donors and breastmilks for dropdowns
    $donors = \App\Models\User::all();
    $breastmilks = \App\Models\BreastMilk::all();

    return view('admin.milkdonors.index', compact('milkdonors', 'donors', 'breastmilks'));
}



  public function create()
{
    $users = \App\Models\User::all();
    $milks = \App\Models\BreastMilk::all();
    return view('admin.milkdonors.create', compact('users', 'milks'));
}

public function store(Request $request)
{
    $request->validate([
        'donor_id' => 'required|exists:users,id',
        'breast_milk_id' => 'required|exists:breast_milk,id',
    ]);

    MilkDonorReqValidation::create([
        'donor_id' => $request->donor_id,
        'breast_milk_id' => $request->breast_milk_id,
        'is_verified' => 0,
    ]);

    return redirect()->route('milkdonors.index')->with('success', 'Milk Donor Request added successfully.');
}

public function show($id)
{
    $donor = MilkDonorReqValidation::with(['donor', 'breastMilk'])->findOrFail($id);
    return view('admin.milkdonors.show', compact('donor'));
}

public function edit($id)
{
    $donor = \App\Models\MilkDonorReqValidation::findOrFail($id);
    $users = \App\Models\User::all();
    $bloods = \App\Models\BreastMilk::all(); // renamed from $milks for consistency with the view

    return view('admin.milkdonors.edit', compact('donor', 'users', 'bloods'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'donor_id' => 'required|exists:users,id',
        'breast_milk_id' => 'required|exists:breast_milk,id',
    ]);
     $donor = \App\Models\MilkDonorReqValidation::findOrFail($id);

    $donor->update([
        'donor_id' => $request->donor_id,
        'breast_milk_id' => $request->breast_milk_id,
        'is_verified' => $request->has('is_verified') ? 1 : 0,
    ]);

    return redirect()->route('milkdonors.index')->with('success', 'Milk Donor Request updated successfully.');
}

public function destroy(MilkDonorReqValidation $donor)
{
    $donor->delete();
    return back()->with('success', 'Milk Donor Request deleted successfully.');
}

}
