@extends('layouts.ist')
@section('title', 'My Grades')
@section('portal-name', '— Student Portal')

@section('sidebar')
    <div class="nav-label">STUDENT MENU</div>
    <a href="{{ route('student.dashboard') }}" class="nav-link"><i class="bi bi-house"></i> Dashboard</a>
    <a href="{{ route('student.courses') }}" class="nav-link"><i class="bi bi-book"></i> My courses</a>
    <a href="{{ route('student.grades') }}" class="nav-link active"><i class="bi bi-star"></i> My grades</a>
    <a href="{{ route('student.attendance') }}" class="nav-link"><i class="bi bi-calendar-check"></i> Attendance</a>
@endsection

@section('content')
    <h4 style="color:#1a1a2e;margin-bottom:4px">Grades & Results</h4>
    <p style="color:#888;font-size:13px;margin-bottom:20px">{{ $student->student_id }} — Semester 1 2024/2025</p>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Overall GPA</div>
                <div class="stat-value" style="color:{{ $gpa >= 3 ? '#0F6E56' : ($gpa >= 2 ? '#854F0B' : '#A32D2D') }}">
                    {{ $gpa }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Courses graded</div>
                <div class="stat-value">{{ $grades->count() }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Passed</div>
                <div class="stat-value" style="color:#0F6E56">
                    {{ $grades->where('status','pass')->count() }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Failed</div>
                <div class="stat-value" style="color:#A32D2D">
                    {{ $grades->where('status','fail')->count() }}
                </div>
            </div>
        </div>
    </div>

    <div class="ist-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            Academic results
            <span class="badge" style="background:#EEEDFE;color:#534AB7">GPA: {{ $gpa }}</span>
        </div>
        <div class="table-responsive">
            <table class="table table-sm mb-0" style="font-size:13px">
                <thead style="background:#fafafa">
                    <tr><th>Course</th><th>Code</th><th>Midterm</th><th>Final</th><th>Total</th><th>Grade</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($grades as $g)
                    <tr>
                        <td>{{ $g->course->name }}</td>
                        <td><code>{{ $g->course->code }}</code></td>
                        <td>{{ $g->midterm ?? '—' }}</td>
                        <td>{{ $g->final ?? '—' }}</td>
                        <td>{{ $g->total ?? '—' }}</td>
                        <td><strong>{{ $g->letter_grade ?? '—' }}</strong></td>
                        <td>
                            <span class="badge badge-{{ $g->status === 'pass' ? 'active' : ($g->status === 'fail' ? 'inactive' : 'pending') }}">
                                {{ ucfirst($g->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No grades recorded yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection