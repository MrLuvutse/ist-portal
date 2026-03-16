@extends('layouts.ist')
@section('title', 'My Courses')
@section('portal-name', '— Student Portal')

@section('sidebar')
    <div class="nav-label">STUDENT MENU</div>
    <a href="{{ route('student.dashboard') }}" class="nav-link"><i class="bi bi-house"></i> Dashboard</a>
    <a href="{{ route('student.courses') }}" class="nav-link active"><i class="bi bi-book"></i> My courses</a>
    <a href="{{ route('student.grades') }}" class="nav-link"><i class="bi bi-star"></i> My grades</a>
    <a href="{{ route('student.attendance') }}" class="nav-link"><i class="bi bi-calendar-check"></i> Attendance</a>
@endsection

@section('content')
    <h4 style="color:#1a1a2e;margin-bottom:4px">My Courses</h4>
    <p style="color:#888;font-size:13px;margin-bottom:20px">{{ $student->student_id }} — {{ $student->program }}</p>

    <h5 style="font-size:15px;margin-bottom:12px">Enrolled courses</h5>
    @if($enrollments->isEmpty())
        <div class="alert alert-info" style="font-size:13px">You are not enrolled in any courses yet.</div>
    @else
    <div class="row g-3 mb-4">
        @foreach($enrollments as $e)
        <div class="col-md-4">
            <div class="ist-card p-3">
                <div style="font-size:11px;color:#c0392b;font-weight:600;margin-bottom:4px">{{ $e->course->code }}</div>
                <div style="font-size:14px;font-weight:500;margin-bottom:4px">{{ $e->course->name }}</div>
                <div style="font-size:12px;color:#888">{{ $e->course->instructor }}</div>
                <div style="font-size:12px;color:#888">{{ $e->course->schedule }}</div>
                <div class="mt-2">
                    <span class="badge badge-active">Enrolled</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($available->count() > 0)
    <h5 style="font-size:15px;margin-bottom:12px">Available courses</h5>
    <div class="ist-card">
        <div class="table-responsive">
            <table class="table table-sm mb-0" style="font-size:13px">
                <thead style="background:#fafafa">
                    <tr><th>Code</th><th>Name</th><th>Instructor</th><th>Schedule</th><th>Credits</th></tr>
                </thead>
                <tbody>
                    @foreach($available as $c)
                    <tr>
                        <td><code>{{ $c->code }}</code></td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->instructor }}</td>
                        <td>{{ $c->schedule }}</td>
                        <td>{{ $c->credits }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
@endsection