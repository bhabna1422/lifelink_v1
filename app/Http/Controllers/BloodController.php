<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BloodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = BloodRequest::query();
    
        // Apply filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        if ($request->filled('blood_group')) {
            $query->where('blood_group', $request->blood_group);
        }
    
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }
    
        if ($request->filled('is_verified')) {
            $query->where('is_verified', $request->is_verified);
        }
    
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('createdAt', [$request->from_date, $request->to_date]);
        }
    
        $bloodRequests = $query->get();
    
        return view('admin.bloods.index', compact('bloodRequests'));
    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin/bloods/create', compact('users'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'requester_id' => 'required|exists:users,id',
            'name' => 'required|string',
            'blood_group' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'expires_at' => 'required|date',
        ]);
    
        BloodRequest::create($request->all());
    
        return redirect()->route('bloods.index')->with('success', 'Blood request added successfully.');
    }
    
    public function show(BloodRequest $blood)
    {
        return view('admin.bloods.show', compact('blood'));
    }
    
    public function destroy(BloodRequest $blood)
    {
        $blood->delete();
        return redirect()->route('bloods.index')->with('success', 'Blood request deleted.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $bloodRequest = BloodRequest::findOrFail($id);
        $users = User::all();
        return view('admin/bloods/edit', compact('bloodRequest', 'users'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'requester_id' => 'required|exists:users,id',
        'name' => 'required|string',
        'blood_group' => 'required|string',
        'dob' => 'required|date',
        'gender' => 'required|string',
        'phone' => 'required|string',
        'address' => 'required|string',
        'expires_at' => 'required|date',
        'status' => 'nullable|string',
    ]);

    $bloodRequest = BloodRequest::findOrFail($id);
    $bloodRequest->update($request->all());

    return redirect()->route('bloods.index')->with('success', 'Blood request updated successfully.');
}
  
}
