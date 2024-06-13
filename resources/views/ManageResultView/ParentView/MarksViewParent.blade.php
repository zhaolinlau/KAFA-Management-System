@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>View Result</h2>
    <p>Name: {{ $result->student->student_name }}</p>
    <p>Matric Id: {{ $result->student_id }}</p>
    <p>Year: {{ $result->student->year }}</p>
    <p>Subject: {{ $result->Subject_name }}</p>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Assessments</th>
                <th>Marks</th>
                <th>Weightage</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Quiz</td>
                <td>{{ $result->Marks }}</td>
                <td>{{ $result->Weightage }}</td>
                <td>{{ $result->Grade }}</td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-secondary">Back</button>
</div>
@endsection