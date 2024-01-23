<?php

declare(strict_types=1);

namespace App\EventSubscriber;


use App\Entity\User;
use App\Event\UserEmailForSendEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class UserEventsSubscriber implements EventSubscriberInterface
{

    public function __construct(private readonly MailerInterface $mailer) {}

    public static function getSubscribedEvents(): array
    {
        return [
            UserEmailForSendEvent::USER_CREATE_ACTION => 'onVerifyEmail'
        ];
    }


    /**
     * @throws TransportExceptionInterface
     */
    public function onVerifyEmail(UserEmailForSendEvent $event): void
    {
        $this->emailForReset(
            $event->getUser(),
            'emails/verificar.html.twig'
        );
    }


    /**
     * @throws TransportExceptionInterface
     */
    private function emailForReset(User $userForReset, string $template = null) : void
    {
        $email = (new Email())
            ->from('no-responder@solucionesia.com')
            ->to($userForReset->getEmail())
            ->subject('Prueba de envío de emails para symfony')
            ->html('Esto es un <b>texto</b> de prueba para probar mailtrap');

        $this->mailer->send($email);

    }
}
