@extends('layouts.ist')
@section('title', 'My Attendance')
@section('portal-name', '— Student Portal')

@section('sidebar')
    <div class="nav-label">STUDENT MENU</div>
    <a href="{{ route('student.dashboard') }}" class="nav-link"><i class="bi bi-house"></i> Dashboard</a>
    <a href="{{ route('student.courses') }}" class="nav-link"><i class="bi bi-book"></i> My courses</a>
    <a href="{{ route('student.grades') }}" class="nav-link"><i class="bi bi-star"></i> My grades</a>
    <a href="{{ route('student.attendance') }}" class="nav-link active"><i class="bi bi-calendar-check"></i> Attendance</a>
@endsection

@section('content')
    <h4 style="color:#1a1a2e;margin-bottom:4px">Attendance Record</h4>
    <p style="color:#888;font-size:13px;margin-bottom:20px">{{ $student->student_id }} — Semester 1 2024/2025</p>

    @php
        $total    = $attendance->count();
        $present  = $attendance->where('status','present')->count();
        $absent   = $attendance->where('status','absent')->count();
        $late     = $attendance->where('status','late')->count();
        $rate     = $total > 0 ? round($present / $total * 100) : 0;
    @endphp

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Overall rate</div>
                <div class="stat-value" style="color:{{ $rate >= 80 ? '#0F6E56' : '#A32D2D' }}">{{ $rate }}%</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Total classes</div>
                <div class="stat-value">{{ $total }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Present</div>
                <div class="stat-value" style="color:#0F6E56">{{ $present }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-label">Absent</div>
                <div class="stat-value" style="color:#A32D2D">{{ $absent }}</div>
            </div>
        </div>
    </div>

    <div class="ist-card">
        <div class="card-header">Detailed attendance log</div>
        <div class="table-responsive">
            <table class="table table-sm mb-0" style="font-size:13px">
                <thead style="background:#fafafa">
                    <tr><th>Date</th><th>Course</th><th>Status</th><th>Notes</th></tr>
                </thead>
                <tbody>
                    @forelse($attendance as $a)
                    <tr>
                        <td>{{ $a->date }}</td>
                        <td>{{ $a->course->name }}</td>
                        <td>
                            <span class="badge badge-{{ $a->status === 'present' ? 'active' : ($a->status === 'late' ? 'pending' : 'inactive') }}">
                                {{ ucfirst($a->status) }}
                            </span>
                        </td>
                        <td>{{ $a->notes ?? '—' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">No attendance records yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection