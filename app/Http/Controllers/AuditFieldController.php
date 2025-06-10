<?php

namespace App\Http\Controllers;

use App\Models\AuditField;
use App\Models\Client;
use Illuminate\Http\Request;

class AuditFieldController extends Controller
{
    //
    public function index($clientId)
    {
        $client = Client::findOrFail($clientId);
        $fields = AuditField::where('client_id', $clientId)->get();
        return view('audit_fields.index', compact('client', 'fields'));
    }
    public function selectClient()
{
    $clients = Client::orderBy('company_name')->get();
    return view('audit_fields.select-client', compact('clients'));
}


    public function store(Request $request, $clientId)
    {
        // $request->validate([
        //     'field_name' => 'required|string|max:255',
        //     'type' => 'required|in:text,dropdown',
        //     'is_required' => 'nullable|boolean',
        //     'description' => 'nullable|string',
        //     'options' => 'nullable|array'
        // ]);

        AuditField::create([
            'client_id' => $clientId,
            'field_name' => strtoupper($request->field_name),
            'description' => $request->description,
            'type' => $request->type,
            'is_required' => $request->has('is_required'),
            'options' => $request->type === 'dropdown' ? json_encode($request->options) : null,
            'created_by' => 1,
        ]);

        return back()->with('success', 'Audit field added successfully.');
    }

    public function update(Request $request, $clientId, AuditField $field)
    {
        $request->validate([
            'field_name' => 'required|string|max:255',
            'type' => 'required|in:text,dropdown',
            'is_required' => 'nullable|boolean',
            'description' => 'nullable|string',
            'options' => 'nullable|array'
        ]);

        $field->update([
            'field_name' => strtoupper($request->field_name),
            'description' => $request->description,
            'type' => $request->type,
            'is_required' => $request->has('is_required'),
            'options' => $request->type === 'dropdown' ? json_encode($request->options) : null,
        ]);

        return back()->with('success', 'Audit field updated.');
    }

    public function destroy($clientId, AuditField $field)
    {
        $field->delete();
        return back()->with('success', 'Audit field deleted.');
    }
}
