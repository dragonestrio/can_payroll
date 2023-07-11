<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = json_decode(json_encode($this->data));
        return $this->to($data->to)
            ->from($data->from, $data->from_name)
            ->subject($data->subject)
            ->cc($data->cc)
            ->bcc($data->bcc)
            ->view($data->view, (array) $data->data_send);
    }
}
