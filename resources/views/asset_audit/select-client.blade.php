@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h4>Select Client for Asset Audit</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="list-group mt-3">
        @foreach($clients as $client)
            <a href="{{ route('asset-audit.index', $client->id) }}" class="list-group-item list-group-item-action">
                {{ $client->company_name }} ({{ $client->contact_person }})
            </a>
        @endforeach
    </div>
</div>
@endsection
