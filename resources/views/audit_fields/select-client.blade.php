@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h4>Select Client for Audit Fields</h4>
    <div class="list-group mt-3">
        @foreach($clients as $client)
            <a href="{{ route('audit-fields.index', $client->id) }}" class="list-group-item list-group-item-action">
                {{ $client->company_name }}
            </a>
        @endforeach
    </div>
</div>
@endsection
