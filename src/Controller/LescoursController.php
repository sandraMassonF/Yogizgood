<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LescoursController extends AbstractController
{
    #[Route('/lescours', name: 'app_lescours')]
    public function index(): Response
    {
        return $this->render('lescours/index.html.twig', [
            'controller_name' => 'LescoursController',
        ]);
    }
}
