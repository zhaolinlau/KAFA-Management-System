<?php
namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResultController extends Controller
{
    public function index(): View
{
    if (auth()->user()->role == 'parent') {
        $studentId = auth()->user()->id; // Assuming the parent's user ID matches the student's user ID
        return view('ManageResultView.ParentView.MarksViewParent', ['results' => Result::with('student')->where('id', $studentId)->get()]);
    } elseif (auth()->user()->role == 'teacher') {
        return view('ManageResultView.TeacherView.StudentList', ['students' => Student::with('results')->get()]);
    }

    abort(403, 'Unauthorized action.');
}

    protected function indexStudent(Request $request): View
    {
        $query = Student::with('results');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('student_name', 'like', '%' . $search . '%')
                  ->orWhere('matric_no', 'like', '%' . $search . '%');
            });
        }

        $students = $query->get();

        return view('ManageResultView.TeacherView.StudentList', ['students' => $students]);
    }

    public function showSubject($studentId): View
{
    $student = Student::with('results')->findOrFail($studentId);

    // Ensure that each subject has default progress set to 'Unfinished'
    foreach ($student->results as $result) {
        if (empty($result->Grade)) {
            $result->Grade = 'Unfinished';
            $result->save();
        }
    }

    // Check if there's already an 'Unfinished' result
    $unfinishedResult = $student->results()->where('Grade', 'Unfinished')->first();

    // If there's no 'Unfinished' result, create one
    if (!$unfinishedResult) {
        $student->results()->create([
            'Subject_name' => 'Kelas 1', // You can set a default name or leave it empty
            'Marks' => json_encode([]),
            'Categories' => json_encode([]),
            'Weightage' => json_encode([]),
            'Grade' => 'Unfinished',
        ]);
    }

    $student = Student::with('results')->findOrFail($studentId);

    return view('ManageResultView.TeacherView.SubjectList', ['student' => $student]);
}
public function showResult($id): View
{
    $result = Result::with('student')->findOrFail($id);

    if (auth()->user()->role == 'teacher') {
        return view('ManageResultView.TeacherView.MarksViewTeacher', ['result' => $result]);
    } elseif (auth()->user()->role == 'parent') {
        return view('ManageResultView.ParentView.MarksViewParent', ['result' => $result]);
    }

    abort(403, 'Unauthorized action.');
}
   

public function updateResult(Request $request, $id): RedirectResponse
{
    $request->validate([
        'Subject_name' => 'required|string|max:255',
        'Marks' => 'required|array',
        'Categories' => 'required|array',
        'Weightage' => 'required|array',
    ]);

    $marks = array_map('floatval', $request->input('Marks'));
    $weightage = array_map('floatval', $request->input('Weightage'));
    $categories = $request->input('Categories');

    $totalGrade = $this->calculateGrade($marks, $weightage);

    // Debug input data
    logger()->debug('Update Result Input Data', [
        'Marks' => $marks,
        'Categories' => $categories,
        'Weightage' => $weightage,
        'Total Grade' => $totalGrade,
    ]);

    $result = Result::findOrFail($id);
    $result->update([
        'Subject_name' => $request->input('Subject_name'),
        'Marks' => json_encode($marks),
        'Categories' => json_encode($categories),
        'Weightage' => json_encode($weightage),
        'Grade' => $totalGrade,
    ]);

    return redirect()->route('results.showResult', $result->id);
}
public function editResult($id): View
{
    $result = Result::with('student')->findOrFail($id);

    // Ensure JSON fields are strings before passing to the view
    $result->Categories = is_string($result->Categories) ? $result->Categories : json_encode($result->Categories);
    $result->Marks = is_string($result->Marks) ? $result->Marks : json_encode($result->Marks);
    $result->Weightage = is_string($result->Weightage) ? $result->Weightage : json_encode($result->Weightage);

    return view('ManageResultView.TeacherView.EditMarks', ['result' => $result]);
}

    public function destroyResult($id): RedirectResponse
    {
        $result = Result::findOrFail($id);
        $result->delete();

        return redirect()->route('results.index');
    }

    private function calculateGrade($marks, $weightage)
    {
        $totalGrade = 0;
        foreach ($marks as $index => $mark) {
            $weight = $weightage[$index] ?? 0;
            $totalGrade += $mark * ($weight / 100);
        }
        return $totalGrade;
    }

    public function addRow($id): RedirectResponse
    {
        $result = Result::findOrFail($id);

        $categories = json_decode($result->Categories, true) ?? [];
        $marks = json_decode($result->Marks, true) ?? [];

        $categories[] = '';
        $marks[] = '';

        $result->Categories = json_encode($categories);
        $result->Marks = json_encode($marks);
        $result->save();

        return redirect()->route('results.editResult', $id);
    }
}
