<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id', 'course_id', 'midterm', 'final', 'total', 'letter_grade', 'status'
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }
    public function course() {
        return $this->belongsTo(Course::class);
    }
}