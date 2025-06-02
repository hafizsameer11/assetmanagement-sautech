<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
     public function index()
    {
        $clients = Client::latest()->get();
        return view('clients.index', compact('clients'));
    }
public function show($id)
{
    $client = Client::findOrFail($id);
    return view('clients.show', compact('client'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'nullable|string|max:255',
            'client_code' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email',
            'audit_start_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:audit_start_date',
            'status' => 'required|in:Planning,Proposal,In Progress,Completed',
        ]);

        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validated = $request->validate([
            'client_name' => 'nullable|string|max:255',
            'client_code' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email',
            'audit_start_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:audit_start_date',
            'status' => 'required|in:Planning,Proposal,In Progress,Completed',
        ]);

        $client->update($validated);

        // Flash modal ID to reopen
        session()->flash('open_modal', 'editClientModal' . $client->id);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        Client::findOrFail($id)->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
