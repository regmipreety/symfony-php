<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class MailerController extends AbstractController
{
    #[Route('/mailer', name: 'app_mailer')]
    public function sendEmail(MailerInterface $mailer, Request $request): Response
    {
        $emailForm = $this->createFormBuilder()
                            -> add('message', TextareaType::class, [
                                'attr'=>array('rows'=> '5')
                            ])
                            ->add('Send', SubmitType::class)
                            ->getForm();
        $emailForm->handleRequest($request);

        if($emailForm->isSubmitted() && $emailForm->isValid()) {
            $data = $emailForm->getData();
            $text = $data['message'];
            $table = 'table1';

            // Render the Twig template with the context variables
            $htmlContent = $this->renderView('mailer/mail.html.twig', [
                'table' => $table,
                'text' => $text,
            ]);

            $email = (new Email())
                        ->from('no-reply@grubhub.com')
                        ->to('sunhi3464@gmail.com')
                        ->subject('Order details')
                        ->html($htmlContent);
                        
            $mailer->send($email);
            $this->addFlash('success','Mail sent successfully.');
            return $this->redirect($this->generateUrl('main'));
        
        }

        return $this->render('mailer/index.html.twig', [
            'emailForm' => $emailForm->createView()
        ]);
    }
}
