@extends('layouts.ist')
@section('title', 'Student Dashboard')
@section('portal-name', '— Student Portal')

@section('sidebar')
    <div class="nav-label">STUDENT MENU</div>
    <a href="{{ route('student.dashboard') }}" class="nav-link active">
        <i class="bi bi-house"></i> Dashboard
    </a>
@endsection

@section('content')
    <h4 style="color:#1a1a2e;margin-bottom:4px">Welcome, {{ Auth::user()->name }}</h4>
    <p style="color:#888;font-size:13px;margin-bottom:20px">
        {{ $student->student_id ?? 'N/A' }} — {{ $student->program ?? 'N/A' }}
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
                <div class="stat-label">Grades recorded</div>
                <div class="stat-value">{{ $grades->count() }}</div>
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
                    <span class="badge badge-{{ $student->status ?? 'active' }}">
                        {{ ucfirst($student->status ?? 'Active') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="ist-card">
        <div class="card-header">My enrolled courses</div>
        <div class="table-responsive">
            <table class="table table-sm mb-0" style="font-size:13px">
                <thead style="background:#fafafa">
                    <tr><th>Course</th><th>Code</th><th>Instructor</th><th>Schedule</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($enrollments as $e)
                    <tr>
                        <td>{{ $e->course->name }}</td>
                        <td><code>{{ $e->course->code }}</code></td>
                        <td>{{ $e->course->instructor }}</td>
                        <td>{{ $e->course->schedule }}</td>
                        <td><span class="badge badge-active">Enrolled</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-3">No courses enrolled yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection