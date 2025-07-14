<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ambulance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AmbulanceController extends Controller
{
    //
 public function index(Request $request)
{
    $query = Ambulance::query()->whereNull('deleted_at');

    \Log::info('Ambulance Filter Inputs:', $request->all());

    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('id')) {
        $query->where('id', $request->id);
    }

    if ($request->filled('is_verified') || $request->is_verified === '0') {
        $query->where('is_verified', $request->is_verified);
    }


    if ($request->filled('otp_session_id')) {
        $query->where('otp_session_id', 'like', '%' . $request->otp_session_id . '%');
    }

    if ($request->filled('creator')) {
        $query->where('creator', 'like', '%' . $request->creator . '%');
    }

    if ($request->filled('reg_number')) {
        $query->where('reg_number', 'like', '%' . $request->reg_number . '%');
    }

    if ($request->filled('group')) {
        $query->where('group', (string) $request->group);
    }

    if ($request->filled('address')) {
        $query->where('address', 'like', '%' . $request->address . '%');
    }

    if ($request->filled('created_from')) {
        $query->whereDate('created_at', '>=', $request->created_from);
    }

    if ($request->filled('created_to')) {
        $query->whereDate('created_at', '<=', $request->created_to);
    }

    \Log::info('SQL:', [$query->toSql(), $query->getBindings()]);

    $ambulances = $query->orderBy('created_at', 'desc')
                        ->paginate(50)
                        ->appends($request->all());

    return view('admin.ambulance.index', compact('ambulances'));
}


    

    public function create()
    {
        $users = User::where('is_ambulance_provider', true)->get();
        return view('admin/ambulance/create', compact('users'));
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'group' => 'nullable|string|max:255',
        'address' => 'nullable|string',
        'landmark' => 'nullable|string',
        'creator' => 'nullable|string',
        'reg_number' => 'nullable|string|max:255',
        'otp_session_id' => 'nullable|string|max:255',
        'otp' => 'nullable|string|max:10',
        'is_verified' => 'boolean'
    ]);

    Ambulance::create($validated);

    return redirect()->route('ambulances.index')->with('success', 'Ambulance added successfully.');
}
public function edit($id)
{
    $ambulance = Ambulance::findOrFail($id);
    $users = User::where('is_ambulance_provider', true)->get();
    return view('admin.ambulance.edit', compact('ambulance', 'users'));
}
public function update(Request $request, $id)
{
    $ambulance = Ambulance::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'group' => 'nullable|string|max:255',
        'address' => 'nullable|string',
        'landmark' => 'nullable|string',
        'creator' => 'nullable|string',
        'reg_number' => 'nullable|string|max:255',
        'otp_session_id' => 'nullable|string|max:255',
        'otp' => 'nullable|string|max:10',
        'is_verified' => 'boolean'
    ]);

    $ambulance->update($validated);

    return redirect()->route('ambulances.index')->with('success', 'Ambulance updated successfully.');
}
public function destroy($id)
{
    $ambulance = Ambulance::findOrFail($id);
    $ambulance->delete(); // soft delete

    return redirect()->route('ambulances.index')->with('success', 'Ambulance deleted successfully.');
}
public function show($id)
{
    $ambulance = Ambulance::findOrFail($id);
    return view('admin.ambulance.show', compact('ambulance'));
}




    
}
