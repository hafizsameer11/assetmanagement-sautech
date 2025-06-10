<div class="col-md-2 p-0 m-0 sidebar specific-scroll" style="height: 100vh; overflow-y: auto;">
    <header>
        <div class="container-1 text-center py-2">
            <img src="{{ asset('assets/img/logofinal.png') }}" class="logo img-fluid" style="max-height: 50px;">
        </div>
    </header>

    <div class="tabs px-2">
        <a href="{{ route('users.index') }}" class="tabbtn d-block py-2">User Management</a>
        <a href="{{ route('clients.index') }}" class="tabbtn d-block py-2">Client Management</a>
        <a href="{{ route('asset-register.select') }}" class="tabbtn d-block py-2">Asset Management</a>
        <a href="{{ route('audit-fields.select') }}" class="tabbtn d-block py-2">Audit Fields</a>
        <a href="{{ route('asset-audit.select') }}" class="tabbtn d-block py-2">Asset Audits</a>

    </div>

    <div class="mt-auto px-2 py-3">
        {{-- <a href="{{ route('logout') }}" class="logout-btn btn btn-sm btn-outline-danger w-100">Logout</a> --}}
    </div>
</div>
