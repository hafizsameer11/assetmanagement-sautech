<?php

namespace App\Http\Controllers;

use App\Models\AssetRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetRegisterController extends Controller
{
    public function index($clientId)
{
    $registers = AssetRegister::where('client_id', $clientId)->latest()->get();
    return view('asset_register.index', compact('registers', 'clientId'));
}

public function upload(Request $request, $clientId)
{
    $request->validate([
        'csv_file' => 'required|mimes:csv,txt|max:2048',
    ]);

    $file = $request->file('csv_file');
    $path = $file->store('asset_registers');

    $rows = array_map('str_getcsv', file($file));
    $headers = array_shift($rows);

    $register = AssetRegister::create([
        'client_id'   => $clientId,
        'filename'    => $file->getClientOriginalName(),
        'columns'     => json_encode($headers),
        'rows'        => json_encode($rows),
        'created_by'  => Auth::id() ,
    ]);

    return back()->with('success', 'Asset register uploaded successfully.');
}

public function destroy($clientId, AssetRegister $register)
{
    $register->delete();
    return back()->with('success', 'Asset register deleted.');
}
public function show($clientId, AssetRegister $register)
{
    $columns = json_decode($register->columns, true);
    $rows = json_decode($register->rows, true);

    return view('asset_register.show', compact('register', 'columns', 'rows', 'clientId'));
}

}
