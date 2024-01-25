<?php

namespace App\Controller;

use App\Entity\User;
use App\Event\UserEmailForSendEvent;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly EntityManagerInterface $entityManager,
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly UserPasswordHasherInterface $userPasswordHasher
    )
    {}

    #[Route('/usuario/nuevo', name: 'app_user')]
    public function nuevo(): Response
    {
        $usuarioForm = $this->createForm(UserFormType::class);
        $usuarioForm->handleRequest($this->requestStack->getCurrentRequest());
        if($usuarioForm->isSubmitted() && $usuarioForm->isValid()){

                /** @var User $user */
                $user = $usuarioForm->getData();

                $encodedPassword = $this->userPasswordHasher->hashPassword(
                    $user,
                    $user->getPassword()
                );
                $user->setPassword($encodedPassword);

                $this->entityManager->persist($user);
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

    #[Route('/usuario/activar/{token}', name: 'app_user_activate')]
    public function activar(#[MapEntity(mapping: ['token' => 'token'])]User $userForActivate): Response
    {
        $userForActivate->setActivo(User::USER_IS_ACTIVE);
        $userForActivate->setToken(null);

        $this->entityManager->persist($userForActivate);
        $this->entityManager->flush();

        $this->addFlash('success','Usuario activado');

        return $this->redirectToRoute('app_login');
    }


}
