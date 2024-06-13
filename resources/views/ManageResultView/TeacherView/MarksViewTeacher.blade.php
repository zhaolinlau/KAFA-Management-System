@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>View Marks for {{ $result->student->student_name }}</h1>
    <h2>Subject: {{ $result->Subject_name }}</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Assessment</th>
                <th>Marks</th>
                <th>Weightage</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @php
                $categories = json_decode($result->Categories) ?? [];
                $marks = json_decode($result->Marks) ?? [];
                $weightage = json_decode($result->Weightage) ?? [];
            @endphp
            @foreach($categories as $index => $category)
                <tr>
                    <td>{{ $category }}</td>
                    <td>{{ $marks[$index] ?? '' }}</td>
                    <td>{{ $weightage[$index] ?? '' }}%</td>
                    <td>{{ $result->Grade }}</td>
                </tr>
            @endforeach
            <tr>
                <td>Total</td>
                <td>{{ array_sum($marks) }}</td>
                <td>{{ array_sum($weightage) }}%</td>
                <td>{{ $result->Grade }}</td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('results.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
