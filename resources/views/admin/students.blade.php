@extends('layouts.ist')
@section('title', 'Students')
@section('portal-name', '— Admin Portal')

@section('sidebar')
    <div class="nav-label">MAIN MENU</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('admin.students') }}" class="nav-link active"><i class="bi bi-people"></i> Students</a>
    <a href="{{ route('admin.courses') }}" class="nav-link"><i class="bi bi-book"></i> Courses</a>
    <a href="{{ route('admin.enrollments') }}" class="nav-link"><i class="bi bi-journal-check"></i> Enrollments</a>
    <a href="{{ route('admin.grades') }}" class="nav-link"><i class="bi bi-star"></i> Grades</a>
    <a href="{{ route('admin.attendance') }}" class="nav-link"><i class="bi bi-calendar-check"></i> Attendance</a>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 style="color:#1a1a2e;margin-bottom:2px">Students</h4>
            <p style="color:#888;font-size:13px;margin:0">Manage all registered students</p>
        </div>
        <a href="{{ route('admin.students.create') }}" class="ist-btn">+ Add student</a>
    </div>

    <div class="ist-card">
        <div class="table-responsive">
            <table class="table table-sm mb-0" style="font-size:13px">
                <thead style="background:#fafafa">
                    <tr>
                        <th>Name</th><th>Student ID</th><th>Email</th>
                        <th>Program</th><th>Status</th><th>Enrolled</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $s)
                    <tr>
                        <td><strong>{{ $s->user->name }}</strong></td>
                        <td><code>{{ $s->student_id }}</code></td>
                        <td>{{ $s->user->email }}</td>
                        <td>{{ $s->program }}</td>
                        <td>
                            <span class="badge badge-{{ $s->status }}">{{ ucfirst($s->status) }}</span>
                        </td>
                        <td>{{ $s->enrollment_date }}</td>
                        <td>
                            <a href="{{ route('admin.students.edit', $s->id) }}"
                               class="btn btn-sm btn-outline-secondary" style="font-size:11px">Edit</a>
                            <form method="POST"
                                  action="{{ route('admin.students.delete', $s->id) }}"
                                  class="d-inline"
                                  onsubmit="return confirm('Delete this student?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" style="font-size:11px">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No students yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection