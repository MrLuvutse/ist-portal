@extends('layouts.ist')
@section('title', 'Grades')
@section('portal-name', '— Admin Portal')

@section('sidebar')
    <div class="nav-label">MAIN MENU</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="{{ route('admin.students') }}" class="nav-link"><i class="bi bi-people"></i> Students</a>
    <a href="{{ route('admin.courses') }}" class="nav-link"><i class="bi bi-book"></i> Courses</a>
    <a href="{{ route('admin.enrollments') }}" class="nav-link"><i class="bi bi-journal-check"></i> Enrollments</a>
    <a href="{{ route('admin.grades') }}" class="nav-link active"><i class="bi bi-star"></i> Grades</a>
    <a href="{{ route('admin.attendance') }}" class="nav-link"><i class="bi bi-calendar-check"></i> Attendance</a>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-md-8">
            <h4 style="color:#1a1a2e;margin-bottom:16px">Grade records</h4>
            <div class="ist-card">
                <div class="table-responsive">
                    <table class="table table-sm mb-0" style="font-size:13px">
                        <thead style="background:#fafafa">
                            <tr><th>Student</th><th>Course</th><th>Midterm</th><th>Final</th><th>Total</th><th>Grade</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            @forelse($grades as $g)
                            <tr>
                                <td>{{ $g->student->user->name }}</td>
                                <td>{{ $g->course->name }}</td>
                                <td>{{ $g->midterm }}</td>
                                <td>{{ $g->final }}</td>
                                <td>{{ $g->total }}</td>
                                <td><strong>{{ $g->letter_grade }}</strong></td>
                                <td><span class="badge badge-{{ $g->status === 'pass' ? 'active' : 'inactive' }}">{{ ucfirst($g->status) }}</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center text-muted py-4">No grades yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h4 style="color:#1a1a2e;margin-bottom:16px">Assign grade</h4>
            <div class="ist-card">
                <div class="p-4">
                    <form method="POST" action="{{ route('admin.grades.store') }}">
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
                            <label class="form-label">Midterm score</label>
                            <input type="number" name="midterm" class="form-control" min="0" max="100" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Final score</label>
                            <input type="number" name="final" class="form-control" min="0" max="100" required>
                        </div>
                        <button type="submit" class="ist-btn w-100">Save grade</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection