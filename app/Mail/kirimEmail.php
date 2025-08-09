<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
     */
    public function attachments(): array
    {
        $attachments = [];
        
        if ($this->attachmentPath && file_exists($this->attachmentPath)) {
            try {
                // Deteksi MIME type berdasarkan ekstensi file
                $extension = pathinfo($this->attachmentPath, PATHINFO_EXTENSION);
                $mimeType = $this->getMimeType($extension);
                
                // Buat nama file untuk attachment
                $originalName = $this->surat->jenis_surat . '_' . $this->surat->nama . '.' . $extension;
                
                $attachments[] = Attachment::fromPath($this->attachmentPath)
                    ->as($originalName)
                    ->withMime($mimeType);
                    
                Log::info('Attachment berhasil ditambahkan: ' . $this->attachmentPath);
                
            } catch (\Exception $e) {
                Log::error('Gagal menambahkan attachment: ' . $e->getMessage());
            }
        } else {
            Log::warning('File attachment tidak ditemukan atau tidak valid: ' . ($this->attachmentPath ?? 'null'));
        }
        
        return $attachments;
    }
    
    /**
     * Get MIME type based on file extension
     */
    private function getMimeType($extension)
    {
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];
        
        return $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
    }
}