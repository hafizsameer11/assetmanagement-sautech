@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <h4>Audit Fields for {{ $client->company_name }}</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Add Field Form -->
        <form action="{{ route('audit-fields.store', $client->id) }}" method="POST" class="border p-3 mb-4">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label>Field Name <span class="text-danger">*</span></label>
                    <input type="text" name="field_name" class="form-control text-uppercase" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label>Type <span class="text-danger">*</span></label>
                    <select name="type" class="form-select" required onchange="toggleOptions(this)">
                        <option value="text">Text</option>
                        <option value="dropdown">Dropdown</option>
                    </select>
                </div>
                <div class="mb-3 col-md-4">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Dropdown Options <small>(Comma separated)</small></label>
                <input type="text" name="options[]" class="form-control" id="dropdownOptions" style="display: none;">
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" name="is_required" id="is_required">
                <label class="form-check-label" for="is_required">Required</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="is_scannable" class="form-check-input" id="is_scannable">
                <label class="form-check-label" for="is_scannable">Enable QR/Barcode Scanner for this field</label>
            </div>

            <button class="btn btn-success">Add Field</button>
        </form>

        <!-- Field List -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Field Name</th>
                    <th>Type</th>
                    <th>Required</th>
                    <th>Description</th>
                    <th>Options</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fields as $index => $field)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $field->field_name }}</td>
                        <td>{{ ucfirst($field->type) }}</td>
                        <td>{{ $field->is_required ? 'Yes' : 'No' }}</td>
                        <td>{{ $field->description }}</td>
                        <td>
                            @if($field->type == 'dropdown')
                                <ul class="mb-0 ps-3">
                                    @foreach(json_decode($field->options, true) as $option)
                                        <li>{{ $option }}</li>
                                    @endforeach
                                </ul>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <!-- Edit (Optional) -->
                            {{-- Add edit modal trigger here if needed --}}
                            <form action="{{ route('audit-fields.destroy', [$client->id, $field->id]) }}" method="POST"
                                class="d-inline" onsubmit="return confirm('Delete this field?')">
                                @csrf
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No fields found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function toggleOptions(select) {
            const optionsInput = document.getElementById('dropdownOptions');
            if (select.value === 'dropdown') {
                optionsInput.style.display = 'block';
            } else {
                optionsInput.style.display = 'none';
            }
        }
    </script>
@endsection
