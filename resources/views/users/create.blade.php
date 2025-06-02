@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <h4>Add New Auditor</h4>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label>Username <span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                    @error('username') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label>Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label>Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn btn-success">Create Auditor</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>

    </div>
@endsection
