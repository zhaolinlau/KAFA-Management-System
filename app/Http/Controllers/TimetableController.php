<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\TimetableEntry;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index()
    {
        $timetables = Timetable::with('entries')->get();
        return view ('timetables.index', compact('timetables'));
    }

    public function create()
    {
        return view('timetables.createTimetable');
    }


    public function store(Request $request)
    {
    $request->validate([
        'class_name' => 'required|string',
        'days' => 'required|array',
        'subject_name' => 'required|array',
        'teacher_name' => 'required|array',
        'start_time' => 'required|array',
        'end_time' => 'required|array',
        'subject_name.*.*' => 'required|string',
        'teacher_name.*.*' => 'required|string',
        'start_time.*.*' => 'required|date_format:H:i',
        'end_time.*.*' => 'required|date_format:H:i|after:start_time.*.*',
    ]);

    $timetable = Timetable::create([
        'class_name' => $request->class_name,
    ]);

    foreach ($request->days as $dayIndex => $day) {
        foreach ($request->subject_name[$dayIndex] as $subjectIndex => $subjectName) {
            TimetableEntry::create([
                'timetable_id' => $timetable->id,
                'day' => $day,
                'subject_name' => $subjectName,
                'teacher_name' => $request->teacher_name[$dayIndex][$subjectIndex],
                'start_time' => $request->start_time[$dayIndex][$subjectIndex],
                'end_time' => $request->end_time[$dayIndex][$subjectIndex],
            ]);
        }
    }

    return redirect()->route('timetables.index')->with('success', 'Timetable created successfully.');
    }


    public function show($id)
{
    $timetable = Timetable::with('entries')->findOrFail($id);
    return view('timetables.show', compact('timetable'));
}
    

    public function edit($id)
    {
        $timetable = Timetable::findOrFail($id);
        return view('timetables.editTimetable', compact('timetable'));
    }


    public function update(Request $request, $id)
    {
        $timetable = Timetable::find($id);
        $timetable->class_name = $request->input('class_name');
        $timetable->save();

        // Update existing entries
        foreach ($request->input('entry_id', []) as $entryId) {
            $entry = TimetableEntry::find($entryId);
            $entry->subject_name = $request->input('subject_name')[$entryId];
            $entry->teacher_name = $request->input('teacher_name')[$entryId];
            $entry->day = $request->input('day')[$entryId];
            $entry->start_time = $request->input('start_time')[$entryId];
            $entry->end_time = $request->input('end_time')[$entryId];
            $entry->save();
        }

        // Add new entries
        if ($request->has('new_days')) {
            foreach ($request->input('new_days') as $newDay) {
                $newSubjects = $request->input("new_subject_name.$newDay", []);
                $newTeachers = $request->input("new_teacher_name.$newDay", []);
                $newStartTimes = $request->input("new_start_time.$newDay", []);
                $newEndTimes = $request->input("new_end_time.$newDay", []);

                for ($i = 0; $i < count($newSubjects); $i++) {
                    $entry = new TimetableEntry();
                    $entry->timetable_id = $timetable->id;
                    $entry->subject_name = $newSubjects[$i];
                    $entry->teacher_name = $newTeachers[$i];
                    $entry->day = $newDay;
                    $entry->start_time = $newStartTimes[$i];
                    $entry->end_time = $newEndTimes[$i];
                    $entry->save();
                }
            }
        }

        return redirect()->route('timetables.show', $timetable->id)->with('success', 'Timetable updated successfully');
    }





    public function destroy($id)
    {
        $timetable = Timetable::findOrFail($id);
        $timetable->delete();

        return redirect()->route('timetables.index')->with('success', 'Timetable deleted successfully.');
    }

}
