<?php

class Mail {

    public static function send($subject, $to, $body) {

        $transport = (new Swift_SmtpTransport(env('MAIL_HOST'), env('MAIL_PORT'),env('MAIL_ENCRYPTION')))
            ->setUsername(env('MAIL_USERNAME'))
            ->setPassword(env('MAIL_PASSWORD'));
        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message($subject))
            ->setFrom([env('MAIL_FROM_ADDRESS') => env('MAIL_FROM_NAME')])
            ->setTo($to)
            ->setBody($body, 'text/html');
        return $mailer->send($message);
    }

}