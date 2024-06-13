@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>List of Subjects</h2>
    <p>Name: {{ $student->student_name }}</p>
    <p>Matric Id: {{ $student->matric_no }}</p>
    <p>Year: {{ $student->year }}</p>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Grade</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student->results as $result)
                <tr>
                    <td>{{ $result->subject_name }}</td>
                    <td>{{ $result->grade }}</td>
                    <td>
                        @if (!empty($result->grade))
                            <a href="{{ route('results.showResult', ['id' => $result->id]) }}" class="text-success">Finished</a>
                        @else
                            <a href="{{ route('results.showResult', ['id' => $result->id]) }}" class="text-danger">Unfinished</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('results.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
