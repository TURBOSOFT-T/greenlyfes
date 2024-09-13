<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestimonialCreated extends Mailable
{
    use Queueable, SerializesModels;

  
    public $testimonial;

    public function __construct($testimonial)
    {
        $this->testimonial = $testimonial;
    }

    public function build()
    {
        return $this->subject('Votre Témoignage a été soumis')
                    ->view('emails.testimonials.created')
                    ->with('testimonial', $this->testimonial);
    }
}
