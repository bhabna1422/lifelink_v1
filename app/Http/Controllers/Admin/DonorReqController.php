<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\DonorReq;
use App\Models\BloodRequest;

class DonorReqController extends Controller
{
    //
  public function index(Request $request)
{
    $query = DonorReq::with(['user', 'blood']);

    // Filters
    if ($request->filled('donor')) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->donor . '%');
        });
    }

    if ($request->filled('blood_request')) {
        $query->whereHas('blood', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->blood_request . '%');
        });
    }

    if ($request->filled('is_verified')) {
        $query->where('is_verified', $request->is_verified);
    }

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
    }

    $donors = $query->latest()->get();

    return view('admin.donors.index', compact('donors'));
}


    public function create()
    {
        $users = \App\Models\User::all();
        $bloods = \App\Models\BloodRequest::all();
        return view('admin.donors.create', compact('users', 'bloods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'donor_id' => 'required|exists:users,id',
            'blood_id' => 'required|exists:blood,id',
        ]);

        DonorReq::create([
            'donor_id' => $request->donor_id,
            'blood_id' => $request->blood_id,
            'is_verified' => 0,
        ]);

        return redirect()->route('donors.index')->with('success', 'Donor Request added successfully.');
    }
    public function show(DonorReq $donor)
    {
        return view('admin.donors.show', compact('donor'));
    }
    public function edit(DonorReq $donor)
    {
        $users = \App\Models\User::all();
        $bloods = \App\Models\BloodRequest::all();
        return view('admin.donors.edit', compact('donor', 'users', 'bloods'));
    }
    public function update(Request $request, DonorReq $donor)
    {
        $request->validate([
            'donor_id' => 'required|exists:users,id',
            'blood_id' => 'required|exists:blood,id',
        ]);

        $donor->update([
            'donor_id' => $request->donor_id,
            'blood_id' => $request->blood_id,
            'is_verified' => $request->is_verified ? 1 : 0,
        ]);

        return redirect()->route('donors.index')->with('success', 'Donor Request updated successfully.');
    }
    public function destroy(DonorReq $donor)
    {
        $donor->delete();
        return back()->with('success', 'Donor Request deleted successfully.');
    }
}
