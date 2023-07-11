<?php

namespace App\Http\Controllers;

use App\Mail\MailSend;
use App\Mail\Payroll;
use Illuminate\Http\Request;
use Mail as GlobalMail;

class Mail extends Controller
{
    public function send($to = null, $from = null, $from_name = null, $subject = null, $cc = null, $bcc = null, $data_send = null, $view = null)
    {
        $data = [
            'to'        => $to,
            'from'      => $from,
            'subject'   => $subject,
            'from_name' => $from_name,
            'cc'        => $cc,
            'bcc'       => $bcc,
            'data_send' => $data_send,
            'view'      => $view,
        ];

        switch ($to) {
            case ($to == null):
                return 'Email Sender is not valid';
                break;
            case ($from == null):
                return 'Email Receiver is not valid';
                break;
            case ($from_name == null):
                return 'Email Name is not valid';
                break;
            case ($subject == null):
                return 'Email Subject is not valid';
                break;
            case ($view == null):
                return 'Email View is not valid';
                break;

            default:
                $result = GlobalMail::send(new MailSend($data));
                if ($result == null) {
                    return true;
                } else {
                    return false;
                }
                break;
        }
    }
}
