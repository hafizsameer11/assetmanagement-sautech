@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Asset Register View</h4>
        <a href="{{ route('asset-register.index', $clientId) }}" class="btn btn-secondary">← Back to List</a>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>File:</strong> {{ $register->filename }}<br>
            <small class="text-muted">Uploaded at: {{ $register->created_at->format('d M Y h:i A') }}</small>
        </div>
        <div class="card-body table-responsive">
            @if(count($columns) && count($rows))
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            @foreach ($columns as $col)
                                <th>{{ strtoupper($col) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                            <tr>
                                @foreach ($row as $value)
                                    <td>{{ strtoupper($value) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning">No data found in this register.</div>
            @endif
        </div>
    </div>
</div>
@endsection
