@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Subjects for {{ $student->student_name }}</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Progress</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student->results as $result)
                <tr>
                    <td>{{ $result->Subject_name }}</td>
                    <td>
                        <a href="{{ route('results.showResult', $result->id) }}" class="btn btn-link">
                            {{ $result->Grade ?? 'Unfinished' }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('results.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
