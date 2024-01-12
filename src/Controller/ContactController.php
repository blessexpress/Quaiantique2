<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        if ($request->request->count() > 0) {
            $name = $request->request->get("name");
            $email = $request->request->get("email");
            $message = $request->request->get("message");

            $mail = (new TemplatedEmail())
                ->from(new Address($email, $name))
                ->to('ayoubberzane@hotmail.com')
                ->replyTo($email)
                ->subject('Nouveau message du formulaire de contact')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'fromName' => $name,
                    'fromEmail' => $email,
                    'message' => $message,
                ]);

            $mailer->send($mail);

            $this->addFlash('success', 'Votre message a bien été envoyé.');

            return $this->redirectToRoute('app_contact');
        }





        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
