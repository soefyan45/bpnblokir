<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailInfo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view(');
        return $this->subject($this->data['subject'])->with(
            [
                'h1'        => 'Aplikasi Layanan Blokir Online BPN KAMPAR',
                'data'      => $this->data,
            ])
            ->from('admin@bpnkampar.my.id')->view('mails.mailsInfo');
    }
}
