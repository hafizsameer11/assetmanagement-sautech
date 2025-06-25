<!-- resources/views/matching/column-mapping.blade.php -->
@extends('layout.app')
@section('content')
<div class="container mt-4">
    <h4>Column Mapping & Matching</h4>
    <form method="POST" action="{{ route('matching.execute') }}">
        @csrf
        <input type="hidden" name="client_id" value="{{ $clientId }}">

        <div id="match-container">
            <div class="row match-group mb-3">
                <div class="col-md-5">
                    <label>Asset Register Column</label>
                    <select name="register_fields[]" class="form-select" required>
                        @foreach($registerColumns as $col)
                            <option value="{{ $col }}">{{ $col }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label>Asset Audit Column</label>
                    <select name="audit_fields[]" class="form-select">
                        @foreach($auditFields as $field)
                            <option value="{{ $field['id'] }}">{{ $field['name'] }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-2">
                    <label>Rule</label>
                    <select name="rules[]" class="form-select" required>
                        <option value="exact">Exact Match</option>
                        <option value="pre">Pre Match</option>
                        <option value="post">Post Match</option>
                        <option value="ignore_0_o">Ignore 0/O</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addMore()">+ Add More</button>
        <br>
        <button class="btn btn-success">Run Matching</button>
    </form>
</div>

<script>
    function addMore() {
        const group = document.querySelector('.match-group').cloneNode(true);
        document.getElementById('match-container').appendChild(group);
    }
</script>
@endsection
