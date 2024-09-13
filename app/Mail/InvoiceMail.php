<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($commande, $pdf)
    {
        $this->commande = $commande;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.invoice')
                    ->subject('Votre Facture')
                    ->attachData($this->pdf->output(), 'facture_commande_' . $this->commande->id . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
