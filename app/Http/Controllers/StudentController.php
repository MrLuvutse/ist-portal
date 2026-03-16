<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Attendance;
use App\Models\Course;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student     = Auth::user()->student;
        $enrollments = Enrollment::with('course')
            ->where('student_id', $student->id)->get();
        $grades      = Grade::with('course')
            ->where('student_id', $student->id)->get();
        $attendance  = Attendance::where('student_id', $student->id)->get();
        $attendanceRate = $attendance->count() > 0
            ? round($attendance->where('status','present')->count() / $attendance->count() * 100)
            : 0;
        $gpa = $this->calculateGPA($grades);
        return view('student.dashboard', compact(
            'student','enrollments','grades','attendanceRate','gpa'
        ));
    }

    public function courses()
    {
        $student     = Auth::user()->student;
        $enrollments = Enrollment::with('course')
            ->where('student_id', $student->id)->get();
        $available   = Course::whereNotIn('id',
            $enrollments->pluck('course_id'))->get();
        return view('student.courses', compact('student','enrollments','available'));
    }

    public function grades()
    {
        $student = Auth::user()->student;
        $grades  = Grade::with('course')
            ->where('student_id', $student->id)->get();
        $gpa     = $this->calculateGPA($grades);
        return view('student.grades', compact('student','grades','gpa'));
    }

    public function attendance()
    {
        $student    = Auth::user()->student;
        $attendance = Attendance::with('course')
            ->where('student_id', $student->id)
            ->orderBy('date','desc')->get();
        $byCoarse   = $attendance->groupBy('course_id');
        return view('student.attendance', compact('student','attendance','byCoarse'));
    }

    private function calculateGPA($grades)
    {
        if ($grades->isEmpty()) return 0;
        $points = ['A+'=>4.0,'A'=>4.0,'B+'=>3.5,'B'=>3.0,'C+'=>2.5,'C'=>2.0,'D'=>1.0,'F'=>0.0];
        $total  = 0;
        $count  = 0;
        foreach ($grades as $g) {
            if ($g->letter_grade && isset($points[$g->letter_grade])) {
                $total += $points[$g->letter_grade];
                $count++;
            }
        }
        return $count > 0 ? round($total / $count, 2) : 0;
    }
}