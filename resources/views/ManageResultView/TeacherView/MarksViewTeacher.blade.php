@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>View Marks</h2>
    <p>Name: {{ $result->student->student_name }}</p>
    <p>Matric Id: {{ $result->student->matric_no }}</p>
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
                <td>{{ $result->Categories }}</td>
                <td>{{ $result->Grade }}</td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('results.editResult', $result->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('results.destroyResult', $result->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Clear</button>
    </form>
    <a href="{{ route('results.createResult') }}" class="btn btn-success">Add</a>
    <a href="{{ route('results.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
