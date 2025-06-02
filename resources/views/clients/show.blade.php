@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Client Details</h4>

    <a href="{{ route('clients.index') }}" class="btn btn-secondary btn-sm mb-3">← Back to List</a>

    <div class="card">
        <div class="card-header">
            <strong>{{ $client->company_name }}</strong>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Contact Person:</strong> {{ $client->contact_person }}
                </div>
                <div class="col-md-6">
                    <strong>Email:</strong> {{ $client->email }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Phone:</strong> {{ $client->phone ?? '-' }}
                </div>
                <div class="col-md-6">
                    <strong>Address:</strong> {{ $client->address ?? '-' }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Client Name:</strong> {{ $client->client_name ?? '-' }}
                </div>
                <div class="col-md-6">
                    <strong>Client Code:</strong> {{ $client->client_code ?? '-' }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <strong>Audit Start Date:</strong> {{ $client->audit_start_date }}
                </div>
                <div class="col-md-6">
                    <strong>Due Date:</strong> {{ $client->due_date }}
                </div>
            </div>

            <div class="mt-3">
                <strong>Status:</strong>
                <span class="badge bg-info">{{ $client->status }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
