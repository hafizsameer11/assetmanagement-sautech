<?php

namespace App\Http\Controllers;

use App\Models\AssetAudit;
use App\Models\AssetRegister;
use App\Models\Client;
use Illuminate\Http\Request;

class MatchingController extends Controller
{
    public function selectClient()
{
    $clients = Client::orderBy('company_name')->get();
    return view('matching.select-client', compact('clients'));
}

public function showColumnMapping(Request $request)
{
    $clientId = $request->client_id;

    // Get latest asset register for the client
    $register = AssetRegister::where('client_id', $clientId)->latest()->first();
    $registerColumns = [];

    if ($register && $register->columns) {
        $registerColumns = is_array($register->columns)
            ? $register->columns
            : json_decode($register->columns, true);
    }

    // Get latest audit entry for the client
    $audit = AssetAudit::where('client_id', $clientId)->latest()->first();

    $auditFields = [];
    if ($audit && $audit->data) {
        $firstRow = is_array($audit->data)
            ? $audit->data
            : json_decode($audit->data, true);

        if (is_array($firstRow)) {
            $fieldIds = array_keys($firstRow);

            $fields = \App\Models\AuditField::whereIn('id', $fieldIds)->get()->keyBy('id');

            foreach ($fieldIds as $id) {
                if (isset($fields[$id])) {
                    $auditFields[] = [
                        'id' => $id,
                        'name' => $fields[$id]->field_name
                    ];
                }
            }
        }
    }

    return view('matching.column-mapping', compact('clientId', 'registerColumns', 'auditFields'));
}



public function executeMatching(Request $request)
{
    $clientId = $request->client_id;
    $rules = $request->rules;

    $matches = [
        'exact' => 0,
        'pre' => 0,
        'post' => 0,
        'ignore_0_o' => 0
    ];

    $total = 0;

    // Get latest asset register
    $register = AssetRegister::where('client_id', $clientId)->latest()->first();
    $registerRows = json_decode($register->rows, true);

    // Get audits with decoded data
    $audits = AssetAudit::where('client_id', $clientId)->get();

    // Fetch audit fields so we can resolve field ID to field name
    $fieldMap = \App\Models\AuditField::where('client_id', $clientId)->get()->keyBy('id');

    foreach ($registerRows as $regRow) {
        foreach ($audits as $audit) {
            $auditRow = is_array($audit->data) ? $audit->data : json_decode($audit->data, true);

            foreach ($request->register_fields as $i => $regCol) {
                if (!isset($request->audit_fields[$i]) || !isset($rules[$i])) continue;

                $auditFieldId = $request->audit_fields[$i];
                $rule = $rules[$i];

                // Resolve audit field ID to field name
                $auditFieldName = $fieldMap[$auditFieldId]->field_name ?? null;

                if (!$auditFieldName || !isset($auditRow[$auditFieldId])) continue;

                $regVal = strtoupper(trim($regRow[$regCol] ?? ''));
                $audVal = strtoupper(trim($auditRow[$auditFieldId] ?? ''));

                $total++;

                switch ($rule) {
                    case 'exact':
                        if ($regVal === $audVal) $matches['exact']++;
                        break;
                    case 'pre':
                        if (str_starts_with($regVal, $audVal)) $matches['pre']++;
                        break;
                    case 'post':
                        if (str_ends_with($regVal, $audVal)) $matches['post']++;
                        break;
                    case 'ignore_0_o':
                        $r = str_ireplace(['0', 'O'], '', $regVal);
                        $a = str_ireplace(['0', 'O'], '', $audVal);
                        if ($r === $a) $matches['ignore_0_o']++;
                        break;
                }
            }
        }
    }

    // Prepare chart data for frontend visualization
    $chartData = [];
    foreach ($matches as $key => $val) {
        $percentage = $total > 0 ? round(($val / $total) * 100, 2) : 0;
        $chartData[] = [
            'label' => ucfirst(str_replace('_', ' ', $key)) . " ({$percentage}%)",
            'value' => $val
        ];
    }

    return view('matching.result', [
        'matches' => $matches,
        'total' => $total,
        'chartData' => $chartData
    ]);
}

}
