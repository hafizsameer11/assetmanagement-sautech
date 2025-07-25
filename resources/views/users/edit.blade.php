@extends('layout.app')

@section('content')
<div class="container-fluid mt-4">
    <h4>Edit Auditor</h4>

   <form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf

    <div class="row">
        <div class="mb-3 col-md-6">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name', default: $user->name) }}" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 col-md-6">
            <label>Username <span class="text-danger">*</span></label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
            @error('username') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-6">
            <label>Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 col-md-6">
            <label>New Password <small class="text-muted">(Leave blank to keep current)</small></label>
            <input type="password" name="password" class="form-control">
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-6">
            <label>Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <button class="btn btn-primary">Update Auditor</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

</div>
@endsection
