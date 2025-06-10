@extends('layout.app')
@section('content')
    <div class="container mt-4">
        <h4>Manual Audit Form</h4>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div> @endif

        <form action="{{ route('manual-audit.store', $clientId) }}" method="POST">
            @csrf
            @foreach($fields as $field)
                <div class="mb-3">
                    <label>{{ $field->field_name }} @if($field->is_required)<span class="text-danger">*</span>@endif</label>
                    @if($field->type === 'dropdown')
                        <select name="field_{{ $field->id }}" class="form-select" @if($field->is_required) required @endif>
                            <option value="">-- Select --</option>
                            @foreach(explode(',', json_decode($field->options ?? '[]')[0] ?? '') as $option)
                                <option value="{{ trim($option) }}">{{ trim($option) }}</option>
                            @endforeach
                        </select>

                    @else
                        @if($field->is_scannable)
                            <div class="input-group">
                                <input type="text" name="field_{{ $field->id }}" id="field_{{ $field->id }}" class="form-control"
                                    value="{{ old("field_{$field->id}") }}" @if($field->is_required) required @endif>
                                <button type="button" class="btn btn-secondary" onclick="startScanner('{{ $field->id }}')">Scan</button>
                            </div>
                            <div id="scanner_{{ $field->id }}" style="width: 300px; display: none;" class="mt-2 border"></div>
                        @else
                            <input type="text" name="field_{{ $field->id }}" class="form-control"
                                value="{{ old("field_{$field->id}") }}" @if($field->is_required) required @endif>
                        @endif

                    @endif
                    @error("field_{$field->id}") <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            @endforeach

            <button class="btn btn-primary">Submit & Next</button>
            <a href="{{ route('manual-audit.history', $clientId) }}" class="btn btn-secondary">View My History</a>
        </form>
    </div>
    <script>
        function startScanner(fieldId) {
            const scannerId = `scanner_${fieldId}`;
            const inputId = `field_${fieldId}`;
            const scannerDiv = document.getElementById(scannerId);
            scannerDiv.style.display = 'block';

            const html5QrCode = new Html5Qrcode(scannerId);
            Html5Qrcode.getCameras().then(devices => {
                if (devices.length) {
                    const cameraId = devices[0].id;
                    html5QrCode.start(
                        cameraId,
                        { fps: 10, qrbox: 250 },
                        result => {
                            document.getElementById(inputId).value = result.toUpperCase();
                            html5QrCode.stop();
                            scannerDiv.innerHTML = '';
                            scannerDiv.style.display = 'none';
                        },
                        error => { }
                    );
                }
            }).catch(() => {
                alert("Camera not accessible.");
            });
        }
    </script>

@endsection

{{-- @section() --}}
