<?php

namespace App\Http\Controllers;

use App\Models\AssetAudit;
use App\Models\AuditField;
use Illuminate\Http\Request;

class AssetAuditController extends Controller
{
    public function index($clientId)
{
    $audits = AssetAudit::where('client_id', $clientId)->latest()->get();
    $fields = AuditField::where('client_id', $clientId)->get();

    return view('asset_audit.index', compact('clientId', 'audits', 'fields'));
}

public function upload(Request $request, $clientId)
{
    $request->validate([
        'csv_file' => 'required|mimes:csv,txt|max:2048',
    ]);

    $file = $request->file('csv_file');
    $rows = array_map('str_getcsv', file($file));

    array_shift($rows); // Ignore first row (headers)

    AssetAudit::create([
        'client_id'   => $clientId,
        'user_id'     =>1,
        'data'        => json_encode($rows),
        'session_token' => session()->getId(),
    ]);

    return back()->with('success', 'Asset audit file uploaded and stored.');
}

public function destroy($clientId, AssetAudit $audit)
{
    $audit->delete();
    return back()->with('success', 'Audit file deleted.');
}
}
