<?php
namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalStudents  = Student::count();
        $totalCourses   = Course::count();
        $totalEnrollments = Enrollment::count();
        $recentStudents = Student::with('user')->latest()->take(5)->get();
        $courses        = Course::withCount('enrollments')->get();

        return view('admin.dashboard', compact(
            'totalStudents', 'totalCourses',
            'totalEnrollments', 'recentStudents', 'courses'
        ));
    }
}