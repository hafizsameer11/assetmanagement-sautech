@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Client Management</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">Add Client</button>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Company</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Audit Dates</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clients as $index => $client)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $client->company_name }}</td>
                        <td>{{ $client->contact_person }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->audit_start_date }} to {{ $client->due_date }}</td>
                        <td><span class="badge bg-info">{{ $client->status }}</span></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning edit-client-btn" data-id="{{ $client->id }}"
                                data-name="{{ $client->client_name }}" data-code="{{ $client->client_code }}"
                                data-address="{{ $client->address }}" data-phone="{{ $client->phone }}"
                                data-company="{{ $client->company_name }}" data-contact="{{ $client->contact_person }}"
                                data-email="{{ $client->email }}" data-start="{{ $client->audit_start_date }}"
                                data-due="{{ $client->due_date }}" data-status="{{ $client->status }}" data-bs-toggle="modal"
                                data-bs-target="#editClientModal">
                                Edit
                            </button>

                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-info">View</a>


                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this client?')">
                                @csrf
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>


                    <!-- Edit Modal -->

                @empty
                    <tr>
                        <td colspan="7" class="text-center">No clients found.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="editClientForm" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editClientModalLabel">Edit Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label>Client Name</label>
                                <input type="text" name="client_name" id="edit_client_name" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Client Code</label>
                                <input type="text" name="client_code" id="edit_client_code" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label>Address</label>
                                <input type="text" name="address" id="edit_address" class="form-control">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Phone</label>
                                <input type="text" name="phone" id="edit_phone" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label>Company Name</label>
                                <input type="text" name="company_name" id="edit_company_name" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Contact Person</label>
                                <input type="text" name="contact_person" id="edit_contact_person" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" id="edit_email" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label>Audit Start Date</label>
                                <input type="date" name="audit_start_date" id="edit_start_date" class="form-control">
                            </div>
                            <div class="mb-3 col-md-3">
                                <label>Due Date</label>
                                <input type="date" name="due_date" id="edit_due_date" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" id="edit_status" class="form-select">
                                <option value="Planning">Planning</option>
                                <option value="Proposal">Proposal</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Client</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Modal for Add Client -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('clients.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Add New Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label>Client Name</label>
                            <input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>Client Code</label>
                            <input type="text" name="client_code" class="form-control" value="{{ old('client_code') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label>Company Name <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" class="form-control" required
                                value="{{ old('company_name') }}">
                            @error('company_name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label>Contact Person <span class="text-danger">*</span></label>
                            <input type="text" name="contact_person" class="form-control" required
                                value="{{ old('contact_person') }}">
                            @error('contact_person') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label>Audit Start Date <span class="text-danger">*</span></label>
                            <input type="date" name="audit_start_date" class="form-control" required
                                value="{{ old('audit_start_date') }}">
                            @error('audit_start_date') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label>Due Date <span class="text-danger">*</span></label>
                            <input type="date" name="due_date" class="form-control" required value="{{ old('due_date') }}">
                            @error('due_date') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="Planning">Planning</option>
                            <option value="Proposal">Proposal</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                        @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Client</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @if(session('open_modal'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let modalId = '{{ session('open_modal') }}';
                let modalEl = document.getElementById(modalId);
                if (modalEl) {
                    new bootstrap.Modal(modalEl).show();
                }
            });
        </script>

    @endif
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-client-btn');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                document.getElementById('editClientForm').action = `/clients/${id}/update`;

                document.getElementById('edit_client_name').value = this.dataset.name;
                document.getElementById('edit_client_code').value = this.dataset.code;
                document.getElementById('edit_address').value = this.dataset.address;
                document.getElementById('edit_phone').value = this.dataset.phone;
                document.getElementById('edit_company_name').value = this.dataset.company;
                document.getElementById('edit_contact_person').value = this.dataset.contact;
                document.getElementById('edit_email').value = this.dataset.email;
                document.getElementById('edit_start_date').value = this.dataset.start;
                document.getElementById('edit_due_date').value = this.dataset.due;
                document.getElementById('edit_status').value = this.dataset.status;
            });
        });
    });
</script>

@endsection
