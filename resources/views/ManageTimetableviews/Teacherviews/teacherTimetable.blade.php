@extends('layouts.app')

@section('content')
<div class="container mt-4">
    @if (auth()->user()->role == 'teacher')
    <h2>View Timetable</h2>
    <form action="{{ route('timetables.index') }}" method="GET">
        <div class="form-group">
            <label for="class_name">Select Class</label>
            <select name="class_name" class="form-control">
                <option selected disabled>Select the class</option>
                <option value="Kelas1Kafa">Kafa 1</option>
                <option value="Kelas2Kafa">Kafa 2</option>
                <option value="Kelas3Kafa">Kafa 3</option>
                <option value="Kelas4Kafa">Kafa 4</option>
                <option value="Kelas5Kafa">Kafa 5</option>
                <option value="Kelas6Kafa">Kafa 6</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-4">View Timetable</button>
    </form>

    @if ($timetable)
        <h3 class="mt-4">Timetable for Class: {{ $timetable->class_name }}</h3>

        @if ($timetable->entries->isEmpty())
            <p>No entries found for this timetable.</p>
        @else
            @php
                $timetableByDay = [];
                foreach ($timetable->entries as $entry) {
                    $timetableByDay[$entry->day][] = $entry;
                }
            @endphp

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Time</th>
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                            <th>{{ $day }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @for ($hour = 13; $hour < 18; $hour++)
                        @php
                            $startTime = sprintf('%02d:30', $hour);
                            $endTime = sprintf('%02d:30', $hour + 1);
                        @endphp

                        <tr>
                            <td>{{ $startTime }} - {{ $endTime }}</td>
                            @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                                <td>
                                    @if ($startTime == '15:30' && $endTime == '16:30')
                                        <div><strong>Rehat</strong></div>
                                    @else
                                        @if (isset($timetableByDay[$day]))
                                            @foreach ($timetableByDay[$day] as $entry)
                                                @if ($entry->start_time >= $startTime && $entry->start_time < $endTime)
                                                    <div>
                                                        <strong>{{ $entry->subject_name }}</strong><br>
                                                        {{ $entry->teacher_name }}<br>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endfor
                </tbody>
            </table>
        @endif
    @endif
    @endif
</div>
@endsection
