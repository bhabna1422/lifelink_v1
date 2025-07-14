<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\BloodRequest;
use App\Models\Ambulance;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $notifications = Notification::latest()->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    public function create()
{
    $users = User::select('id', 'name')->get();
    $bloodRequests = BloodRequest::select('id', 'name')->get(); // assuming `name` field exists
    $ambulances = Ambulance::select('id', 'name')->get();       // assuming `name` field exists

    return view('admin.notifications.create', compact('users', 'bloodRequests', 'ambulances'));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'message' => 'required',
        'type' => 'nullable|string',
        'initiater_id' => 'nullable|exists:users,id',
        'blood_req_id' => 'nullable|exists:blood,id',
        'ambulance_req_id' => 'nullable|exists:ambulances,id',
    ]);

    Notification::create($request->all());

    return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');
}
public function show(Notification $notification)
    {
        return view('admin.notifications.show', compact('notification'));
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }
}
