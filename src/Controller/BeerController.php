<?php

namespace App\Controller;

use App\Repository\BeerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class BeerController extends AbstractController
{
    #[Route('/beers', name: 'app_beer')]
    public function index(BeerRepository $beerRepository): Response
    {
        return $this->render('dashboard/beers/list.html.twig', [
            'beers' => $beerRepository->findAll(),
        ]);
    }

    #[Route('/beers/translated', name: 'app_beer')]
    public function translated(TranslatorInterface $translator): Response
    {
        return new Response($translator->trans('num_of_beers', ['beers' => 10]));
    }
}
