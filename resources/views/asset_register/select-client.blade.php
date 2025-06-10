@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h4>Select a Client to Manage Asset Registers</h4>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    @if($clients->isEmpty())
        <div class="alert alert-warning mt-3">No clients available.</div>
    @else
        <div class="list-group mt-3">
            @foreach($clients as $client)
                <a href="{{ route('asset-register.index', $client->id) }}"
                   class="list-group-item list-group-item-action">
                    <strong>{{ $client->company_name }}</strong> — {{ $client->contact_person }} ({{ $client->email }})
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
