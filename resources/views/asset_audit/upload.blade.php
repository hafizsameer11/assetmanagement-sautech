@extends('layout.app')
@section('content')
<div class="container">
    <h4>Upload Audit CSV</h4>
    <form action="{{ route('asset-audit.upload-preview', $clientId) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file" required class="form-control my-3">
        <button class="btn btn-primary">Preview Mapping</button>
    </form>
</div>
@endsection
