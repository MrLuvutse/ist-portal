<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'code', 'name', 'description', 'instructor',
        'credits', 'schedule', 'max_students', 'status'
    ];

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }
    public function students() {
        return $this->belongsToMany(Student::class, 'enrollments');
    }
    public function grades() {
        return $this->hasMany(Grade::class);
    }
    public function attendances() {
        return $this->hasMany(Attendance::class);
    }
}