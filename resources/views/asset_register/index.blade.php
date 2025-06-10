@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Asset Registers</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload CSV</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($registers->count())
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Filename</th>
                    <th>Uploaded At</th>
                    <th>Uploaded By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registers as $index => $register)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $register->filename }}</td>
                    <td>{{ $register->created_at->format('d M Y H:i') }}</td>
                    <td>{{ $register->user->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('asset-register.show', [$clientId, $register->id]) }}" class="btn btn-sm btn-info">View</a>
                        <form action="{{ route('asset-register.destroy', [$clientId, $register->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this register?')">
                            @csrf
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning">No asset registers uploaded yet.</div>
    @endif
</div>

{{-- Upload Modal --}}
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('asset-register.upload', $clientId) }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Upload Asset Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>CSV File <span class="text-danger">*</span></label>
                    <input type="file" name="csv_file" class="form-control" required>
                    <small class="text-muted">Max size: 2MB</small>
                    @error('csv_file') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Upload</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection
