@extends('layouts.ist')
@section('title', 'Courses')
@section('portal-name', '— Admin Portal')

@section('sidebar')
    <div class="nav-label">MAIN MENU</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('admin.students') }}" class="nav-link"><i class="bi bi-people"></i> Students</a>
    <a href="{{ route('admin.courses') }}" class="nav-link active"><i class="bi bi-book"></i> Courses</a>
    <a href="{{ route('admin.enrollments') }}" class="nav-link"><i class="bi bi-journal-check"></i> Enrollments</a>
    <a href="{{ route('admin.grades') }}" class="nav-link"><i class="bi bi-star"></i> Grades</a>
    <a href="{{ route('admin.attendance') }}" class="nav-link"><i class="bi bi-calendar-check"></i> Attendance</a>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-md-7">
            <h4 style="color:#1a1a2e;margin-bottom:16px">Courses</h4>
            <div class="ist-card">
                <div class="table-responsive">
                    <table class="table table-sm mb-0" style="font-size:13px">
                        <thead style="background:#fafafa">
                            <tr><th>Code</th><th>Name</th><th>Instructor</th><th>Students</th><th>Status</th><th></th></tr>
                        </thead>
                        <tbody>
                            @forelse($courses as $c)
                            <tr>
                                <td><code>{{ $c->code }}</code></td>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->instructor }}</td>
                                <td>{{ $c->enrollments_count }}</td>
                                <td><span class="badge badge-{{ $c->status }}">{{ ucfirst($c->status) }}</span></td>
                                <td>
                                    <form method="POST" action="{{ route('admin.courses.delete', $c->id) }}"
                                          onsubmit="return confirm('Delete this course?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" style="font-size:11px">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted py-4">No courses yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <h4 style="color:#1a1a2e;margin-bottom:16px">Add new course</h4>
            <div class="ist-card">
                <div class="p-4">
                    <form method="POST" action="{{ route('admin.courses.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Course code</label>
                            <input name="code" class="form-control" placeholder="WD-101" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course name</label>
                            <input name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instructor</label>
                            <input name="instructor" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Schedule</label>
                            <input name="schedule" class="form-control" placeholder="Mon/Wed 9:00 AM">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Credits</label>
                            <input type="number" name="credits" class="form-control" value="3">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Max students</label>
                            <input type="number" name="max_students" class="form-control" value="30">
                        </div>
                        <button type="submit" class="ist-btn w-100">Add course</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection