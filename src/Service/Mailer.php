<?php


namespace App\Service;


use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class Mailer
{
    protected $mailer;
    private $templating;

    public function __construct(MailerInterface $mailer, Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function sendContactEmail($from, $to, $contactData, $subject, $view)
    {
        $email = new Email();
        $email
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->html($this->templating->render($view, ['contactData' => $contactData]));

        $this->mailer->send($email);
    }
}
