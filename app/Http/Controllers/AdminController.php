<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $totalStudents    = Student::count();
        $totalCourses     = Course::count();
        $totalEnrollments = Enrollment::count();
        $avgAttendance    = 0;
        $total            = Attendance::count();
        if ($total > 0) {
            $avgAttendance = round(Attendance::where('status','present')->count() / $total * 100);
        }
        $recentStudents = Student::with('user')->latest()->take(5)->get();
        $courses        = Course::withCount('enrollments')->get();
        return view('admin.dashboard', compact(
            'totalStudents','totalCourses','totalEnrollments',
            'avgAttendance','recentStudents','courses'
        ));
    }

    // Students
    public function students()
    {
        $students = Student::with('user')->latest()->get();
        return view('admin.students', compact('students'));
    }

    public function createStudent()
    {
        return view('admin.students_create');
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'name'             => 'required',
            'email'            => 'required|email|unique:users',
            'password'         => 'required|min:6',
            'student_id'       => 'required|unique:students',
            'program'          => 'required',
            'enrollment_date'  => 'required|date',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'student',
        ]);

        Student::create([
            'user_id'         => $user->id,
            'student_id'      => $request->student_id,
            'phone'           => $request->phone,
            'program'         => $request->program,
            'status'          => $request->status ?? 'active',
            'enrollment_date' => $request->enrollment_date,
        ]);

        return redirect()->route('admin.students')->with('success', 'Student created successfully!');
    }

    public function editStudent($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('admin.students_edit', compact('student'));
    }

    public function updateStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update([
            'program' => $request->program,
            'phone'   => $request->phone,
            'status'  => $request->status,
        ]);
        $student->user->update(['name' => $request->name]);
        return redirect()->route('admin.students')->with('success', 'Student updated!');
    }

    public function deleteStudent($id)
    {
        $student = Student::findOrFail($id);
        $student->user->delete();
        return redirect()->route('admin.students')->with('success', 'Student deleted!');
    }

    // Courses
    public function courses()
    {
        $courses = Course::withCount('enrollments')->get();
        return view('admin.courses', compact('courses'));
    }

    public function storeCourse(Request $request)
    {
        $request->validate([
            'code'       => 'required|unique:courses',
            'name'       => 'required',
            'instructor' => 'required',
        ]);
        Course::create($request->all());
        return redirect()->route('admin.courses')->with('success', 'Course created!');
    }

    public function deleteCourse($id)
    {
        Course::findOrFail($id)->delete();
        return redirect()->route('admin.courses')->with('success', 'Course deleted!');
    }

    // Enrollments
    public function enrollments()
    {
        $enrollments = Enrollment::with(['student.user','course'])->latest()->get();
        $students    = Student::with('user')->get();
        $courses     = Course::all();
        return view('admin.enrollments', compact('enrollments','students','courses'));
    }

    public function storeEnrollment(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'course_id'  => 'required',
        ]);
        Enrollment::firstOrCreate(
            ['student_id' => $request->student_id, 'course_id' => $request->course_id],
            ['status' => 'enrolled', 'enrolled_at' => now()]
        );
        return redirect()->route('admin.enrollments')->with('success', 'Student enrolled!');
    }

    // Grades
    public function grades()
    {
        $grades   = Grade::with(['student.user','course'])->latest()->get();
        $students = Student::with('user')->get();
        $courses  = Course::all();
        return view('admin.grades', compact('grades','students','courses'));
    }

    public function storeGrade(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'course_id'  => 'required',
            'midterm'    => 'required|numeric|min:0|max:100',
            'final'      => 'required|numeric|min:0|max:100',
        ]);
        $total  = ($request->midterm + $request->final) / 2;
        $letter = $this->getLetterGrade($total);
        $status = $total >= 50 ? 'pass' : 'fail';

        Grade::updateOrCreate(
            ['student_id' => $request->student_id, 'course_id' => $request->course_id],
            ['midterm' => $request->midterm, 'final' => $request->final,
             'total' => $total, 'letter_grade' => $letter, 'status' => $status]
        );
        return redirect()->route('admin.grades')->with('success', 'Grade saved!');
    }

    private function getLetterGrade($total)
    {
        if ($total >= 90) return 'A+';
        if ($total >= 85) return 'A';
        if ($total >= 80) return 'B+';
        if ($total >= 75) return 'B';
        if ($total >= 70) return 'C+';
        if ($total >= 65) return 'C';
        if ($total >= 60) return 'D';
        return 'F';
    }

    // Attendance
    public function attendance()
    {
        $records  = Attendance::with(['student.user','course'])->latest()->take(50)->get();
        $students = Student::with('user')->get();
        $courses  = Course::all();
        return view('admin.attendance', compact('records','students','courses'));
    }

    public function storeAttendance(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'course_id'  => 'required',
            'date'       => 'required|date',
            'status'     => 'required',
        ]);
        Attendance::updateOrCreate(
            ['student_id' => $request->student_id,
             'course_id'  => $request->course_id,
             'date'       => $request->date],
            ['status' => $request->status, 'notes' => $request->notes]
        );
        return redirect()->route('admin.attendance')->with('success', 'Attendance marked!');
    }
}