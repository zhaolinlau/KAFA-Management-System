@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" id="success-alert">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-4">
    <h2>Timetable for Class: {{ $timetable->class_name }}</h2>

    @if ($timetable->entries->isEmpty())
        <p>No entries found for this timetable.</p>
    @else
        <!-- Create an associative array to group entries by day -->
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
                <!-- Generate time slots from 13:00 to 18:00 with 1-hour intervals -->
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
                                    <div>
                                        <strong>Rehat</strong>
                                    </div>
                                @else
                                    @if (isset($timetableByDay[$day]))
                                        @foreach ($timetableByDay[$day] as $entry)
                                            @if ($entry->start_time >= $startTime && $entry->start_time < $endTime)
                                                <div>
                                                    <strong>{{ $entry->subject_name }}</strong><br>
                                                    {{ $entry->teacher_name }}<br>
                                                    {{-- {{ $entry->start_time }} - {{ $entry->end_time }}  --}}
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

    <div class="mt-3">
        <a href="{{ route('timetables.index') }}" class="btn btn-secondary">Back to Timetables</a>
        <a href="{{ route('timetables.edit', $timetable->id) }}" class="btn btn-primary">Edit Timetable</a>
        <form action="{{ route('timetables.destroy', $timetable->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this timetable?')">Delete</button>
        </form>
    </div>
</div>

<script>
     // Make alert message dissappear after three seconds
     document.addEventListener('DOMContentLoaded', function () {
        const alert = document.getElementById('success-alert') || document.getElementById('error-alert');
        if (alert) {
            // Automatically hide the alert after 3 seconds
            setTimeout(() => {
                alert.classList.add('fade');
                // Remove the alert element from the DOM after it fades out
                setTimeout(() => {
                    alert.remove();
                }, 150);
            }, 3000);
        }
    });
</script>

{{-- CSS styling for alert page --}}
<style>
    .alert {
        position: fixed;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1050;  
        width: 50%;
    }
</style>
@endsection
