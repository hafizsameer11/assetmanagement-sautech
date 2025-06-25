<!-- resources/views/matching/select-client.blade.php -->
@extends('layout.app')
@section('content')
<div class="container mt-4">
    <h4>Select Client for Matching</h4>
    <form method="GET" action="{{ route('matching.fields') }}">
        <div class="mb-3">
            <select name="client_id" class="form-select" required>
                <option value="">-- Select Client --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Next</button>
    </form>
</div>
@endsection
