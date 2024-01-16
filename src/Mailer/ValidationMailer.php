<?php


namespace App\Mailer;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ValidationMailer
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendValidationEmail(string $recipient): void
    {
        $email = (new Email())
            ->from('envoiecolis@soninkaraconnect.com')
            ->to($recipient)
            ->subject('Validation de réservation')
            ->html('<p>Votre réservation a été validée avec succès.</p>');

        $this->mailer->send($email);
    }
}
