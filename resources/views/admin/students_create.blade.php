@extends('layouts.ist')
@section('title', 'Add Student')
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
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.students') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
        <h4 style="color:#1a1a2e;margin:0">Add new student</h4>
    </div>

    <div class="ist-card" style="max-width:600px">
        <div class="card-header">Student details</div>
        <div class="p-4">
            @if($errors->any())
                <div class="alert alert-danger" style="font-size:13px">
                    @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('admin.students.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full name</label>
                        <input name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Student ID</label>
                        <input name="student_id" class="form-control" placeholder="ST-2024-001" value="{{ old('student_id') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Program</label>
                        <select name="program" class="form-control" required>
                            <option value="">Select program</option>
                            <option value="Web Development">Web Development</option>
                            <option value="Cybersecurity">Cybersecurity</option>
                            <option value="Data Science">Data Science</option>
                            <option value="Mobile Development">Mobile Development</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Enrollment date</label>
                        <input type="date" name="enrollment_date" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="ist-btn">Create student</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection