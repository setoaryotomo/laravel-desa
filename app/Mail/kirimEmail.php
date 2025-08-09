<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class kirimEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $surat;
    public $attachmentPath;

    /**
     * Create a new message instance.
     */
    public function __construct($surat, $attachmentPath = null)
    {
        $this->surat = $surat;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permohonan Surat - ' . $this->surat->jenis_surat,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.kirimemail',
            with: [
                'surat' => $this->surat,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if ($this->attachmentPath) {
            return [
                \Illuminate\Mail\Mailables\Attachment::fromPath($this->attachmentPath)
                    ->as('surat.pdf')
                    ->withMime('application/pdf'),
            ];
        }
        
        return [];
    }
}