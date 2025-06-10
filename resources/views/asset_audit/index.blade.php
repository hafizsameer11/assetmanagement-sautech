@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Asset Audit Upload</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($fields->isEmpty())
        <div class="alert alert-warning">
            No audit fields are defined for this client yet.
            <a href="{{ route('audit-fields.index', $clientId) }}" class="btn btn-sm btn-outline-primary ms-2">Create Fields</a>
        </div>
    @else
        <form action="{{ route('asset-audit.upload-preview', $clientId) }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input type="file" name="csv_file" accept=".csv" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary">Upload CSV</button>
                </div>
            </div>
        </form>
    @endif

    <h5>Uploaded Files</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Uploaded By</th>
                <th>Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse($audits as $index => $audit)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $audit->user->name ?? 'Unknown' }}</td>
                    <td>{{ $audit->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <form method="POST" action="{{ route('asset-audit.destroy', [$clientId, $audit->id]) }}">
                            @csrf
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this audit file?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">No audit files uploaded yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
