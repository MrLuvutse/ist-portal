@extends('layouts.ist')
@section('title', 'Admin Dashboard')
@section('portal-name', '— Admin Portal')

@section('sidebar')
    <div class="nav-label">MAIN MENU</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link active">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
@endsection

@section('content')
    <h4 style="color:#1a1a2e;margin-bottom:4px">Admin Dashboard</h4>
    <p style="color:#888;font-size:13px;margin-bottom:20px">Welcome back, {{ Auth::user()->name }}</p>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Total students</div>
                <div class="stat-value">{{ $totalStudents }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Active courses</div>
                <div class="stat-value">{{ $totalCourses }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Enrollments</div>
                <div class="stat-value">{{ $totalEnrollments }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">My role</div>
                <div class="stat-value" style="font-size:18px;padding-top:4px">
                    <span class="badge" style="background:#EEEDFE;color:#534AB7;font-size:13px">Admin</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-7">
            <div class="ist-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Recent students
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0" style="font-size:13px">
                        <thead style="background:#fafafa">
                            <tr>
                                <th>Name</th><th>Student ID</th><th>Program</th><th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentStudents as $s)
                            <tr>
                                <td>{{ $s->user->name }}</td>
                                <td><code>{{ $s->student_id }}</code></td>
                                <td>{{ $s->program }}</td>
                                <td>
                                    <span class="badge badge-{{ $s->status }}">{{ ucfirst($s->status) }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">No students yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="ist-card">
                <div class="card-header">Courses overview</div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0" style="font-size:13px">
                        <thead style="background:#fafafa">
                            <tr><th>Course</th><th>Students</th></tr>
                        </thead>
                        <tbody>
                            @forelse($courses as $c)
                            <tr>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->enrollments_count }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="2" class="text-center text-muted py-3">No courses yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection