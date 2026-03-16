@extends('layouts.ist')
@section('title', 'Student Dashboard')
@section('portal-name', '— Student Portal')

@section('sidebar')
    <div class="nav-label">STUDENT MENU</div>
    <a href="{{ route('student.dashboard') }}" class="nav-link active"><i class="bi bi-house"></i> Dashboard</a>
    <a href="{{ route('student.courses') }}" class="nav-link"><i class="bi bi-book"></i> My courses</a>
    <a href="{{ route('student.grades') }}" class="nav-link"><i class="bi bi-star"></i> My grades</a>
    <a href="{{ route('student.attendance') }}" class="nav-link"><i class="bi bi-calendar-check"></i> Attendance</a>
@endsection

@section('content')
    <h4 style="color:#1a1a2e;margin-bottom:4px">Welcome, {{ Auth::user()->name }}</h4>
    <p style="color:#888;font-size:13px;margin-bottom:20px">
        {{ $student->student_id }} — {{ $student->program }}
    </p>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Enrolled courses</div>
                <div class="stat-value">{{ $enrollments->count() }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Overall GPA</div>
                <div class="stat-value" style="color:{{ $gpa >= 3 ? '#0F6E56' : '#854F0B' }}">{{ $gpa }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Attendance rate</div>
                <div class="stat-value" style="color:{{ $attendanceRate >= 80 ? '#0F6E56' : '#A32D2D' }}">
                    {{ $attendanceRate }}%
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Status</div>
                <div class="stat-value" style="font-size:18px;padding-top:4px">
                    <span class="badge badge-{{ $student->status }}">{{ ucfirst($student->status) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-7">
            <div class="ist-card">
                <div class="card-header d-flex justify-content-between">
                    My enrolled courses
                    <a href="{{ route('student.courses') }}" style="font-size:12px;color:#c0392b">View all</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0" style="font-size:13px">
                        <thead style="background:#fafafa">
                            <tr><th>Course</th><th>Code</th><th>Instructor</th><th>Schedule</th></tr>
                        </thead>
                        <tbody>
                            @forelse($enrollments as $e)
                            <tr>
                                <td>{{ $e->course->name }}</td>
                                <td><code>{{ $e->course->code }}</code></td>
                                <td>{{ $e->course->instructor }}</td>
                                <td>{{ $e->course->schedule }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">No courses enrolled yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="ist-card">
                <div class="card-header d-flex justify-content-between">
                    Recent grades
                    <a href="{{ route('student.grades') }}" style="font-size:12px;color:#c0392b">View all</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0" style="font-size:13px">
                        <thead style="background:#fafafa">
                            <tr><th>Course</th><th>Grade</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            @forelse($grades->take(4) as $g)
                            <tr>
                                <td>{{ $g->course->name }}</td>
                                <td><strong>{{ $g->letter_grade ?? '—' }}</strong></td>
                                <td>
                                    <span class="badge badge-{{ $g->status === 'pass' ? 'active' : 'inactive' }}">
                                        {{ ucfirst($g->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-muted py-3">No grades yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection