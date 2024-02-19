<?php

namespace App\Controller;

use App\Form\EmployeeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    #[Route('/employee', name: 'app_employee')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(EmployeeFormType::class);
        $form->handleRequest($request);

        return $this->render('employee/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
