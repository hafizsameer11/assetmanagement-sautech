@extends('layout.app')
@section('content')
    <div class="container">
        <h4>Select Client for Audit</h4>
        <ul class="list-group">
            @foreach($clients as $client)
                <li class="list-group-item">
                    <a href="{{ route('asset-audit.index', $client->id) }}">{{ $client->company_name }}</a>
                </li>
            @endforeach
        </ul>
        <h4>Select Client for Audit -- auditor</h4>
        <ul class="list-group">
            @foreach($clients as $client)
                <li class="list-group-item">
                    <a href="{{ route('manual-audit.form', $client->id) }}">{{ $client->company_name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
