@extends('layout.app')
@section('content')
    <div class="container">
        <h4>Map CSV Columns to Audit Fields</h4>
        <form action="{{ route('asset-audit.upload-store', $clientId) }}" method="POST">
            @csrf
            <input type="hidden" name="rows" value="{{ json_encode($rows) }}">
            @foreach($fields as $field)
                <div class="mb-2">
                    <label>{{ $field->field_name }}</label>
                    <select name="mapping[{{ $field->id }}]" class="form-select" required>
                        <option value="">Select Column</option>
                        @foreach($headers as $index => $header)
                            <option value="{{ $index }}" {{ strtolower($header) === strtolower($field->field_name) ? 'selected' : '' }}>
                                {{ $header }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach

            <button type="submit" class="btn btn-success">Import</button>
        </form>
    </div>
@endsection
