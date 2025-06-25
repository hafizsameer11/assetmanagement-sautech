<!-- resources/views/matching/result.blade.php -->
@extends('layout.app')
@section('content')
<div class="container mt-4">
    <h4>Match Summary</h4>
    <ul>
        @foreach ($matches as $type => $count)
            <li>{{ ucfirst(str_replace('_', ' ', $type)) }}: {{ $count }} matches</li>
        @endforeach
        <li>Total Comparisons: {{ $total }}</li>
    </ul>
    {{-- <img src="data:image/png;base64,{{ $chartData }}" alt="Pie Chart Summary" class="img-fluid"> --}}
</div>
@endsection
