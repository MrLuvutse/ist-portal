<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeStudentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $studentName;
    public $studentId;
    public $email;
    public $password;
    public $program;

    public function __construct($studentName, $studentId, $email, $password, $program)
    {
        $this->studentName = $studentName;
        $this->studentId   = $studentId;
        $this->email       = $email;
        $this->password    = $password;
        $this->program     = $program;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Welcome to IST System — Your Account is Ready');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.welcome_student');
    }
}