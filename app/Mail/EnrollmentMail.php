<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnrollmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $studentName;
    public $courseName;
    public $courseCode;
    public $instructor;
    public $schedule;

    public function __construct($studentName, $courseName, $courseCode, $instructor, $schedule)
    {
        $this->studentName = $studentName;
        $this->courseName  = $courseName;
        $this->courseCode  = $courseCode;
        $this->instructor  = $instructor;
        $this->schedule    = $schedule;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Course Enrollment Confirmation — IST System');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.enrollment');
    }
}