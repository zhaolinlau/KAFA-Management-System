@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Timetable</h2>
    <form action="{{ route('timetables.update', $timetable->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="class_name">Class</label>
            <select name="class_name" class="form-control" required>
                <option value="Kelas1Kafa" {{ $timetable->class_name == 'Kelas1Kafa' ? 'selected' : '' }}>Kafa 1</option>
                <option value="Kelas2Kafa" {{ $timetable->class_name == 'Kelas2Kafa' ? 'selected' : '' }}>Kafa 2</option>
                <option value="Kelas3Kafa" {{ $timetable->class_name == 'Kelas3Kafa' ? 'selected' : '' }}>Kafa 3</option>
                <option value="Kelas4Kafa" {{ $timetable->class_name == 'Kelas4Kafa' ? 'selected' : '' }}>Kafa 4</option>
                <option value="Kelas5Kafa" {{ $timetable->class_name == 'Kelas5Kafa' ? 'selected' : '' }}>Kafa 5</option>
                <option value="Kelas6Kafa" {{ $timetable->class_name == 'Kelas6Kafa' ? 'selected' : '' }}>Kafa 6</option>
            </select>
        </div>

        <div id="days-container">
            @foreach($timetable->entries->groupBy('day') as $day => $entries)
            <div class="day-group">
                <h4>{{ $day }}</h4>
                <input type="hidden" name="days[]" value="{{ $day }}">
                @foreach($entries as $entry)
                <div class="entry-group">
                    <input type="hidden" name="entry_id[]" value="{{ $entry->id }}">
                    <div class="form-group">
                        <label for="subject_name_{{ $entry->id }}">Subject</label>
                        <select name="subject_name[{{ $entry->id }}]" class="form-control subject-select" data-entry-id="{{ $entry->id }}">
                            <option value="UlumSyariahAkidahIbadah" {{ $entry->subject_name == 'UlumSyariahAkidahIbadah' ? 'selected' : '' }}>Ulum Syariah Akidah Ibadah</option>
                            <option value="Sirah" {{ $entry->subject_name == 'Sirah' ? 'selected' : '' }}>Sirah</option>
                            <option value="JawiKhat" {{ $entry->subject_name == 'JawiKhat' ? 'selected' : '' }}>Jawi Khat</option>
                            <option value="AdabAkhlakIslamiah" {{ $entry->subject_name == 'AdabAkhlakIslamiah' ? 'selected' : '' }}>Adab Akhlak Islamiah</option>
                            <option value="LughatulQuran" {{ $entry->subject_name == 'LughatulQuran' ? 'selected' : '' }}>Lughatul Quran</option>
                            <option value="AmaliSolat" {{ $entry->subject_name == 'AmaliSolat' ? 'selected' : '' }}>Amali Solat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="teacher_name_{{ $entry->id }}">Teacher</label>
                        <select name="teacher_name[{{ $entry->id }}]" class="form-control teacher-select" data-entry-id="{{ $entry->id }}">
                            <option value="{{ $entry->teacher_name }}" selected>{{ $entry->teacher_name }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="day_{{ $entry->id }}">Day</label>
                        <select name="day[{{ $entry->id }}]" class="form-control" required>
                            <option value="Monday" {{ $entry->day == 'Monday' ? 'selected' : '' }}>Monday</option>
                            <option value="Tuesday" {{ $entry->day == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                            <option value="Wednesday" {{ $entry->day == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                            <option value="Thursday" {{ $entry->day == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                            <option value="Friday" {{ $entry->day == 'Friday' ? 'selected' : '' }}>Friday</option>
                            <option value="Saturday" {{ $entry->day == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                            <option value="Sunday" {{ $entry->day == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_time_{{ $entry->id }}">Start Time</label>
                        <input type="time" name="start_time[{{ $entry->id }}]" class="form-control" value="{{ $entry->start_time }}" required>
                    </div>
                    <div class="form-group">
                        <label for="end_time_{{ $entry->id }}">End Time</label>
                        <input type="time" name="end_time[{{ $entry->id }}]" class="form-control" value="{{ $entry->end_time }}" required>
                    </div>
                </div>
                @endforeach
                <button type="button" class="btn btn-secondary add-entry" data-day="{{ $day }}">Add Another Subject for {{ $day }}</button>
            </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-primary" id="add-day">Add New Day</button>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>

<script>
const teachersBySubject = {
    'UlumSyariahAkidahIbadah': ['Ustazah Aisyah', 'Ustaz Amin'],
    'Sirah': ['Ustaz Aiman', 'Ustaz Amir'],
    'JawiKhat': ['Ustazah Aminah', 'Ustazah Kamilah'],
    'AdabAkhlakIslamiah': ['Ustaz Amzar', 'Ustaz Zakaria'],
    'LughatulQuran': ['Ustazah Hajar', 'Ustaz Zaki'],
    'AmaliSolat': ['Ustazah Halimah', 'Ustazah Hasnah'],
};

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.subject-select').forEach(function (select) {
        select.addEventListener('change', function () {
            updateTeacherOptions(select, select.closest('.entry-group').querySelector('.teacher-select'));
        });
    });

    document.querySelectorAll('.add-entry').forEach(function (button) {
        button.addEventListener('click', function () {
            addNewEntry(button.dataset.day);
        });
    });

    document.getElementById('add-day').addEventListener('click', function () {
        addNewDay();
    });

    function updateTeacherOptions(subjectSelect, teacherSelect) {
        const subject = subjectSelect.value;
        const teachers = teachersBySubject[subject] || [];
        teacherSelect.innerHTML = '<option value="" selected>Select the teacher</option>';
        teachers.forEach(function (teacher) {
            const option = document.createElement('option');
            option.value = teacher;
            option.textContent = teacher;
            teacherSelect.appendChild(option);
        });
    }

    function addNewEntry(day) {
        const dayGroup = Array.from(document.querySelectorAll('.day-group')).find(group => group.querySelector('h4').textContent === day);
        const entryGroup = document.createElement('div');
        entryGroup.classList.add('entry-group');

        const subjectSelect = document.createElement('select');
        subjectSelect.name = `new_subject_name[${day}][]`;
        subjectSelect.classList.add('form-control', 'mt-2', 'subject-select');
        const subjects = ['UlumSyariahAkidahIbadah', 'Sirah', 'JawiKhat', 'AdabAkhlakIslamiah', 'LughatulQuran', 'AmaliSolat'];
        subjects.forEach(subject => {
            const option = document.createElement('option');
            option.value = subject;
            option.textContent = subject;
            subjectSelect.appendChild(option);
        });
        entryGroup.appendChild(subjectSelect);

        const teacherSelect = document.createElement('select');
        teacherSelect.name = `new_teacher_name[${day}][]`;
        teacherSelect.classList.add('form-control', 'mt-2', 'teacher-select');
        teacherSelect.innerHTML = '<option value="" selected>Select the teacher</option>';
        entryGroup.appendChild(teacherSelect);

        const startTimeInput = document.createElement('input');
        startTimeInput.type = 'time';
        startTimeInput.name = `new_start_time[${day}][]`;
        startTimeInput.classList.add('form-control', 'mt-2');
        startTimeInput.required = true;
        entryGroup.appendChild(startTimeInput);

        const endTimeInput = document.createElement('input');
        endTimeInput.type = 'time';
        endTimeInput.name = `new_end_time[${day}][]`;
        endTimeInput.classList.add('form-control', 'mt-2');
        endTimeInput.required = true;
        entryGroup.appendChild(endTimeInput);

        subjectSelect.addEventListener('change', function () {
            updateTeacherOptions(subjectSelect, teacherSelect);
        });

        dayGroup.insertBefore(entryGroup, dayGroup.querySelector('.add-entry'));
    }

    function addNewDay() {
        const newDayName = prompt('Enter the name of the new day:');
        if (!newDayName) {
            return;
        }

        const daysContainer = document.getElementById('days-container');
        const dayGroup = document.createElement('div');
        dayGroup.classList.add('day-group');
        dayGroup.innerHTML = `
            <h4>${newDayName}</h4>
            <input type="hidden" name="new_days[]" value="${newDayName}">
            <button type="button" class="btn btn-secondary add-entry" data-day="${newDayName}">Add Another Subject for ${newDayName}</button>
        `;

        daysContainer.appendChild(dayGroup);
        dayGroup.querySelector('.add-entry').addEventListener('click', function () {
            addNewEntry(newDayName);
        });

        addNewEntry(newDayName); // Add the first entry automatically
    }
});
</script>
@endsection
