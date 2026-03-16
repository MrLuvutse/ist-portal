<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GradeAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $studentName;
    public $courseName;
    public $midterm;
    public $final;
    public $total;
    public $letterGrade;
    public $status;

    public function __construct($studentName, $courseName, $midterm, $final, $total, $letterGrade, $status)
    {
        $this->studentName  = $studentName;
        $this->courseName   = $courseName;
        $this->midterm      = $midterm;
        $this->final        = $final;
        $this->total        = $total;
        $this->letterGrade  = $letterGrade;
        $this->status       = $status;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Your Grade Has Been Recorded — IST System');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.grade_assigned');
    }
}