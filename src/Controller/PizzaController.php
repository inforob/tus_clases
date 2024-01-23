<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{


    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/pizza', name: 'app_pizza')]
    public function index(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('rmanchado@tilomotion.com')
            ->to('manchadoroberto@gmail.com')
            ->subject('Prueba de envío de emails para symfony')
            ->html('Esto es un <b>texto</b> de prueba para probar mailtrap');

        $mailer->send($email);

        return new Response('email enviado correctamente');
    }
}
