<?php

namespace App\Mail;

use App\Models\ServiceRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServiceRequestTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ServiceRequest $serviceRequest,
        public ?string $waUrl = null,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tiket Pengajuan Layanan - ' . $this->serviceRequest->kode,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.tiket-layanan',
            with: [
                'serviceRequest' => $this->serviceRequest,
                'waUrl'          => $this->waUrl,
                'logoUrl'        => asset('images/logo_pustekinfo_landscape.png'),
            ],
        );
    }

    public function attachments(): array
    {
        $logoPath = public_path('images/logo_pustekinfo_landscape.png');
        $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));

        $pdf = Pdf::loadView('pdf.tiket-layanan', [
            'serviceRequest' => $this->serviceRequest,
            'logoBase64'     => $logoBase64,
        ])->setPaper('a4', 'portrait');

        return [
            Attachment::fromData(fn () => $pdf->output(), 'Tiket-' . $this->serviceRequest->kode . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
