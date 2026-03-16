<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id', 'student_id', 'phone', 'program', 'status', 'enrollment_date'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }
    public function courses() {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
    public function grades() {
        return $this->hasMany(Grade::class);
    }
    public function attendances() {
        return $this->hasMany(Attendance::class);
    }
}