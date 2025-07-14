<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipient;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
{
    $query = Recipient::query();

    // Apply filters
    if ($request->filled('push_id')) {
        $query->where('push_id', 'like', '%' . $request->push_id . '%');
    }

    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }

    if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('created_at', [
            $request->from_date . ' 00:00:00',
            $request->to_date . ' 23:59:59'
        ]);
    }

   $recipients = $query->with('user')->orderBy('created_at', 'desc')->get();

    $users = \App\Models\User::all(); // For user dropdown

    return view('admin.recipients.index', compact('recipients', 'users'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all(); // you can also paginate or search via Ajax
        return view('admin/recipients/create', compact('users'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'push_id' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);
    
        Recipient::create([
            'push_id' => $request->push_id,
            'user_id' => $request->user_id,
        ]);
    
        return redirect()->route('recipients.index')->with('success', 'Recipient added successfully.');
    }
    public function edit($id)
{
    $recipient = Recipient::findOrFail($id);
    $users = User::all();

    return view('admin.recipients.edit', compact('recipient', 'users'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'push_id' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
    ]);

    $recipient = Recipient::findOrFail($id);

    $recipient->update([
        'push_id' => $request->push_id,
        'user_id' => $request->user_id,
    ]);

    return redirect()->route('recipients.index')->with('success', 'Recipient updated successfully.');
}

    
    public function show($id)
    {
        $recipient = Recipient::findOrFail($id);
        return view('admin/recipients/show', compact('recipient'));
    }
    
    
    public function destroy($id)
    {
        $recipient = Recipient::findOrFail($id);
        $recipient->delete();
    
        return redirect()->route('recipients.index')->with('success', 'Recipient deleted.');
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
