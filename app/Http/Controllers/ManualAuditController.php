<?php

namespace App\Http\Controllers;

use App\Models\AssetAudit;
use App\Models\AuditField;
use Illuminate\Http\Request;

class ManualAuditController extends Controller
{
    public function form($clientId)
    {
        $fields = AuditField::where('client_id', $clientId)->get();
        return view('manual_audit.form', compact('clientId', 'fields'));
    }

    public function store(Request $request, $clientId)
    {
        $fields = AuditField::where('client_id', $clientId)->get();
        $data = [];

        foreach ($fields as $field) {
            $value = $request->input("field_{$field->id}");
            if ($field->is_required && empty($value)) {
                return back()->withErrors(["field_{$field->id}" => 'This field is required.'])->withInput();
            }
            $data[$field->id] = strtoupper($value ?? '');
        }

        AssetAudit::create([
            'client_id' => $clientId,
            'user_id' => 1,
            'data' => $data,
            'session_token' => session()->getId(),
        ]);

        return back()->with('success', 'Entry saved. You can continue auditing.');
    }

  public function history($clientId)
{
    $audits = AssetAudit::where('client_id', $clientId)
        // ->where('user_id', auth()->id())
        ->latest()->get();

    $fieldMap = AuditField::where('client_id', $clientId)
        ->pluck('field_name', 'id') // returns [id => field_name]
        ->toArray();

    return view('manual_audit.history', compact('audits', 'clientId', 'fieldMap'));
}

}
