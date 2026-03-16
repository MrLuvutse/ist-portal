@extends('layouts.ist')
@section('title', 'Edit Student')
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
        <h4 style="color:#1a1a2e;margin:0">Edit student</h4>
    </div>
    <div class="ist-card" style="max-width:600px">
        <div class="card-header">{{ $student->user->name }}</div>
        <div class="p-4">
            <form method="POST" action="{{ route('admin.students.update', $student->id) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full name</label>
                        <input name="name" class="form-control" value="{{ $student->user->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input name="phone" class="form-control" value="{{ $student->phone }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Program</label>
                        <select name="program" class="form-control">
                            @foreach(['Web Development','Cybersecurity','Data Science','Mobile Development'] as $p)
                            <option value="{{ $p }}" {{ $student->program === $p ? 'selected' : '' }}>{{ $p }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            @foreach(['active','inactive','suspended'] as $s)
                            <option value="{{ $s }}" {{ $student->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="ist-btn">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection