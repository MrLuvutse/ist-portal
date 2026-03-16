<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AbsenceNoticeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $studentName;
    public $courseName;
    public $date;
    public $notes;

    public function __construct($studentName, $courseName, $date, $notes)
    {
        $this->studentName = $studentName;
        $this->courseName  = $courseName;
        $this->date        = $date;
        $this->notes       = $notes;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Absence Notice — IST System');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.absence_notice');
    }
}