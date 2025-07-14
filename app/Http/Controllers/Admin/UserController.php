<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
public function index(Request $request)
{
    $query = User::query();

    // Basic filters
    if ($request->filled('id')) {
        $query->where('id', $request->id);
    }
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }
    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }
    if ($request->filled('phone')) {
        $query->where('phone', 'like', '%' . $request->phone . '%');
    }
    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }
    if ($request->filled('blood_group')) {
        $query->where('blood_group', $request->blood_group);
    }
    if ($request->filled('fcm_token')) {
        $query->where('fcm_token', 'like', '%' . $request->fcm_token . '%');
    }
    if ($request->filled('location')) {
        $query->where('location', 'like', '%' . $request->location . '%');
    }
    if ($request->filled('coordinate')) {
        $query->where('coordinate', 'like', '%' . $request->coordinate . '%');
    }

    // DOB range
    if ($request->filled('dob_from')) {
        $query->whereDate('dob', '>=', $request->dob_from);
    }
    if ($request->filled('dob_to')) {
        $query->whereDate('dob', '<=', $request->dob_to);
    }

    // Created at range
    if ($request->filled('created_from')) {
        $query->whereDate('created_at', '>=', $request->created_from);
    }
    if ($request->filled('created_to')) {
        $query->whereDate('created_at', '<=', $request->created_to);
    }

    // Updated at range
    if ($request->filled('updated_from')) {
        $query->whereDate('updated_at', '>=', $request->updated_from);
    }
    if ($request->filled('updated_to')) {
        $query->whereDate('updated_at', '<=', $request->updated_to);
    }

    // Boolean fields
      // Boolean fields
    foreach (['is_donor', 'is_milk_donor', 'is_ambulance_provider', 'is_deleting'] as $field) {
    if ($request->filled($field) || $request->$field === '0') {
        $query->where($field, $request->$field);
    }
}


    // Other fields
    if ($request->filled('admin_message')) {
        $query->where('admin_message', 'like', '%' . $request->admin_message . '%');
    }

    if ($request->filled('delete_status')) {
        $query->where('delete_status', $request->delete_status);
    }

    // Get data
    $users = $query->orderBy('created_at', 'desc')->get();

    return view('admin.user.index', compact('users', 'request'));
}




    public function create()
    {
        // Show the form to create a new user
        return view('admin/user/create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'fcm_token' => 'nullable|string',
            'location' => 'nullable|string',
            'coordinate' => 'nullable|string',
            'is_donor' => 'nullable|boolean',
            'is_milk_donor' => 'nullable|boolean',
            'is_ambulance_provider' => 'nullable|boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User added successfully.');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin/user/show', compact('user'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin/user/edit', compact('user'));
    }
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6',
        'phone' => 'nullable|string',
        'dob' => 'nullable|date',
        'gender' => 'nullable|string',
        'blood_group' => 'nullable|string',
        'fcm_token' => 'nullable|string',
        'location' => 'nullable|string',
        'coordinate' => 'nullable|string',
        'is_donor' => 'nullable|boolean',
        'is_milk_donor' => 'nullable|boolean',
        'is_ambulance_provider' => 'nullable|boolean',
    ]);

    // Hash password only if it's provided
    if (!empty($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
    } else {
        unset($validated['password']); // don't update password
    }

    $user->update($validated);

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->is_deleting = 1;
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'User marked as deleted.');
    }
public function deleted(Request $request)
{
    // Include only soft-deleted users
    $query = User::where('is_deleting', 1);

    // Apply filters
    if ($request->filled('id')) {
        $query->where('id', $request->id);
    }

    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    if ($request->filled('phone')) {
        $query->where('phone', 'like', '%' . $request->phone . '%');
    }

    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    if ($request->filled('blood_group')) {
        $query->where('blood_group', $request->blood_group);
    }

    if ($request->filled('fcm_token')) {
        $query->where('fcm_token', 'like', '%' . $request->fcm_token . '%');
    }

    if ($request->filled('location')) {
        $query->where('location', 'like', '%' . $request->location . '%');
    }

    if ($request->filled('coordinate')) {
        $query->where('coordinate', 'like', '%' . $request->coordinate . '%');
    }

    if ($request->filled('dob_from')) {
        $query->whereDate('dob', '>=', $request->dob_from);
    }

    if ($request->filled('dob_to')) {
        $query->whereDate('dob', '<=', $request->dob_to);
    }

    if ($request->filled('created_from')) {
        $query->whereDate('created_at', '>=', $request->created_from);
    }

    if ($request->filled('created_to')) {
        $query->whereDate('created_at', '<=', $request->created_to);
    }

    if ($request->filled('updated_from')) {
        $query->whereDate('updated_at', '>=', $request->updated_from);
    }

    if ($request->filled('updated_to')) {
        $query->whereDate('updated_at', '<=', $request->updated_to);
    }

    foreach (['is_donor', 'is_milk_donor', 'is_ambulance_provider'] as $field) {
        if ($request->has($field) && $request->$field !== '') {
            $query->where($field, $request->$field);
        }
    }

    if ($request->filled('admin_message')) {
        $query->where('admin_message', 'like', '%' . $request->admin_message . '%');
    }

    if ($request->filled('delete_status')) {
        $query->where('delete_status', $request->delete_status);
    }

    $users = $query->orderBy('created_at', 'desc')->get();

    return view('admin.user.deleted', compact('users'));
}




}
