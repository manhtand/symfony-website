<?php

namespace App\Controller;

use App\Form\ContactFormType;
use PharIo\Manifest\Email;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

class ContactUsController extends AbstractController
{
    #[Route('/contact-us', name: 'contactus', methods: ['POST'])]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        $successMessage = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $contactForm = $form->getData();
//            $email = (new Email())
//                ->to('info@nbastatic.com')
//                ->from('contactus@nbastatic.com')
//                ->subject('You got new message!')
//                ->text('This is your message!');
//
//            try {
//                $mailer->send($email);
//            } catch (TransportException $exception) {
//                $form->addError(new FormError('Could not send your request!'));
//                $logger->error('Problem sending email', [
//                    'error' => $exception->getMessage(),
//                ]);
//            }

            $successMessage = 'Message was sent.';
        }

        return $this->render('widget/contact_us.twig', [
            'form' => $form,
            'successMessage' => $successMessage,
        ]);
    }
}
