<?php

declare(strict_types=1);

namespace App\EventSubscriber;


use App\Entity\User;
use App\Event\UserEmailForSendEvent;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
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
        $this->emailForSignUp(
            $event->getUser(),
            'emails/verificar.html.twig'
        );
    }


    /**
     * @throws TransportExceptionInterface
     */
    private function emailForSignUp(User $userForSignUp, string $template = null) : void
    {
        $email = (new TemplatedEmail())
            ->from('no-responder@tuapp.com')
            ->to(new Address($userForSignUp->getEmail()))
            ->subject('Se necesita verificar email')

            // path of the Twig template to render
            ->htmlTemplate('emails/signup.html.twig')
            ->context([
                'user' => $userForSignUp
            ]);

        $this->mailer->send($email);

    }
}
