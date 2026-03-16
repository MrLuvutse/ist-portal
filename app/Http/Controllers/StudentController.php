<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Attendance;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student    = Auth::user()->student;
        $enrollments = Enrollment::with('course')
            ->where('student_id', $student->id)->get();
        $grades     = Grade::with('course')
            ->where('student_id', $student->id)->get();
        $attendance = Attendance::where('student_id', $student->id)->get();

        $attendanceRate = $attendance->count() > 0
            ? round($attendance->where('status', 'present')->count() / $attendance->count() * 100)
            : 0;

        return view('student.dashboard', compact(
            'student', 'enrollments', 'grades', 'attendanceRate'
        ));
    }
}