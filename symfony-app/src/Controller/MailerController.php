<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class MailerController extends AbstractController
{
    #[Route('/mailer', name: 'app_mailer')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
                    ->from('no-reply@grubhub.com')
                    ->to('sunhi3464@gmail.com')
                    ->subject('Order')
                    ->text('send email');
        $mailer->send($email);
        $this->addFlash('success','Mail sent successfully.');
        return $this->render('mailer/index.html.twig');
    }
}
