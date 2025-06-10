@extends('layout.app')
@section('content')
    <div class="container mt-4">
        <h4>My Audit History</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fields</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($audits as $i => $audit)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                            @foreach($audit->data as $key => $val)
                                <strong>{{ $fieldMap[$key] ?? 'Unknown Field' }}:</strong> {{ $val }}<br>
                            @endforeach

                        </td>
                        <td>{{ $audit->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No records yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
