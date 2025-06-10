<?php

namespace App\Http\Controllers;

use App\Models\AssetAudit;
use App\Models\AuditField;
use App\Models\Client;
use Illuminate\Http\Request;

class AssetAuditController extends Controller
{
    public function selectClient()
    {
        $clients = Client::orderBy('company_name')->get();
        return view('asset_audit.select-client', compact('clients'));
    }

    public function index($clientId)
    {
        $audits = AssetAudit::where('client_id', $clientId)->latest()->get();
        $fields = AuditField::where('client_id', $clientId)->get();

        return view('asset_audit.index', compact('clientId', 'audits', 'fields'));
    }

    public function showUploadForm($clientId)
    {
        $fields = AuditField::where('client_id', $clientId)->get();

        if ($fields->isEmpty()) {
            return redirect()->back()->with('error', 'No audit fields found for this client.');
        }

        return view('asset_audit.upload', compact('clientId', 'fields'));
    }

    public function uploadPreview(Request $request, $clientId)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $rows = array_map('str_getcsv', file($file));
        $headers = array_shift($rows);

        $fields = AuditField::where('client_id', $clientId)->get();

        return view('asset_audit.preview-mapping', compact('clientId', 'headers', 'rows', 'fields'));
    }

  public function uploadStore(Request $request, $clientId)
{
    $request->validate([
        'mapping' => 'required',
        'rows' => 'required'
    ]);

    // Decode the rows JSON string
    $decodedRows = json_decode($request->input('rows'), true);

    foreach ($decodedRows as $row) {
        $mapped = [];

        foreach ($request->mapping as $fieldId => $columnIndex) {
            $mapped[$fieldId] = $row[$columnIndex] ?? null;
        }

        AssetAudit::create([
            'client_id' => $clientId,
            'user_id' => auth()->id() ?? 1,
            'data' => $mapped,
            'session_token' => session()->getId(),
        ]);
    }

    return redirect()->route('asset-audit.index', $clientId)->with('success', 'Audit records saved successfully.');
}


    public function destroy($clientId, AssetAudit $audit)
    {
        $audit->delete();
        return back()->with('success', 'Audit file deleted.');
    }
}
