<?php

namespace App\Controller;

use App\Event\UserEmailForSendEvent;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly EntityManagerInterface $entityManager,
        private readonly EventDispatcherInterface $eventDispatcher
    )
    {}

    #[Route('/usuario/nuevo', name: 'app_user')]
    public function nuevo(): Response
    {
        $usuarioForm = $this->createForm(UserFormType::class);
        $usuarioForm->handleRequest($this->requestStack->getCurrentRequest());
        if($usuarioForm->isSubmitted() && $usuarioForm->isValid()){

                $this->entityManager->persist($usuarioForm->getData());
                $this->entityManager->flush();

                $this->eventDispatcher->dispatch(
                    new UserEmailForSendEvent($usuarioForm->getData()),
                    UserEmailForSendEvent::USER_CREATE_ACTION
                );

                $this->addFlash('success','El usuario se ha registrado con éxito');
        }

        return $this->render('usuario/nuevo.html.twig', [
            'form' => $usuarioForm->createView(),
        ]);
    }


}
