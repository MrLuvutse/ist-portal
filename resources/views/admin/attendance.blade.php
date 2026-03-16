@extends('layouts.ist')
@section('title', 'Attendance')
@section('portal-name', '— Admin Portal')

@section('sidebar')
    <div class="nav-label">MAIN MENU</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('admin.students') }}" class="nav-link"><i class="bi bi-people"></i> Students</a>
    <a href="{{ route('admin.courses') }}" class="nav-link"><i class="bi bi-book"></i> Courses</a>
    <a href="{{ route('admin.enrollments') }}" class="nav-link"><i class="bi bi-journal-check"></i> Enrollments</a>
    <a href="{{ route('admin.grades') }}" class="nav-link"><i class="bi bi-star"></i> Grades</a>
    <a href="{{ route('admin.attendance') }}" class="nav-link active"><i class="bi bi-calendar-check"></i> Attendance</a>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-md-8">
            <h4 style="color:#1a1a2e;margin-bottom:16px">Attendance records</h4>
            <div class="ist-card">
                <div class="table-responsive">
                    <table class="table table-sm mb-0" style="font-size:13px">
                        <thead style="background:#fafafa">
                            <tr><th>Student</th><th>Course</th><th>Date</th><th>Status</th><th>Notes</th></tr>
                        </thead>
                        <tbody>
                            @forelse($records as $r)
                            <tr>
                                <td>{{ $r->student->user->name }}</td>
                                <td>{{ $r->course->name }}</td>
                                <td>{{ $r->date }}</td>
                                <td>
                                    <span class="badge badge-{{ $r->status === 'present' ? 'active' : ($r->status === 'late' ? 'pending' : 'inactive') }}">
                                        {{ ucfirst($r->status) }}
                                    </span>
                                </td>
                                <td>{{ $r->notes ?? '—' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">No records yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h4 style="color:#1a1a2e;margin-bottom:16px">Mark attendance</h4>
            <div class="ist-card">
                <div class="p-4">
                    <form method="POST" action="{{ route('admin.attendance.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Student</label>
                            <select name="student_id" class="form-control" required>
                                <option value="">Select student</option>
                                @foreach($students as $s)
                                <option value="{{ $s->id }}">{{ $s->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <select name="course_id" class="form-control" required>
                                <option value="">Select course</option>
                                @foreach($courses as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control"
                                   value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="late">Late</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes (optional)</label>
                            <input name="notes" class="form-control" placeholder="Any notes...">
                        </div>
                        <button type="submit" class="ist-btn w-100">Mark attendance</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection