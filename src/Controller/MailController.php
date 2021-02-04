<?php

namespace App\Controller;

use App\Entity\Mail;
use App\Form\MailType;
use App\Repository\MailRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailController extends AbstractController
{
    /**
     * @Route("/mail", name="mail")
     */
    public function index(): Response
    {
        return $this->render('mail/index.html.twig', [
            'mail' => 'index mail',
        ]);
    }

    /**
     * @Route("/new", name="new_mail", methods={"GET","POST"})
     */
    public function new(Request $request, MailerInterface $mailer): Response
    {
    	$mail = new Mail();
        $form = $this->createForm(MailType::class, $mail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mail);
            $entityManager->flush();
            $email = (new Email())
            ->from('hello@example.com')
            ->to($mail->getEmail())
            ->subject('Symfony Mailer!')
            ->text($mail->getMessage());
            //->html('<p>'.$mail->getMessage()'</p>');
        	/** @var Symfony\Component\Mailer\SentMessage $sentEmail */
        	$sentEmail = $mailer->send($email);
            return $this->redirectToRoute('mail-response');
        }

        return $this->render('mail/index.html.twig', [
        	'mail' => $mail,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/sendmail")
     */
    public function sendEmail($mailer)
    {
    	//$mailer = new MailerInterface;
        $email = (new Email())
            ->from('hello@example.com')
            ->to('afuentesmarquez28@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        /** @var Symfony\Component\Mailer\SentMessage $sentEmail */
        $sentEmail = $mailer->send($email);
        // $messageId = $sentEmail->getMessageId();

        // ...
    }

    /**
     * @Route("/mail-response", name="mail-response")
     */
    public function sendResponseMail(): Response
    {
        return $this->render('mail/mailSend.html.twig', [
            'mail' => 'send exito mail',
        ]);
    }
}
