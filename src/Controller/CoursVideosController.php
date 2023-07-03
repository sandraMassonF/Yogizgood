<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursVideosController extends AbstractController
{
    #[Route('/cours/videos', name: 'app_cours_videos')]
    public function index(): Response
    {
        return $this->render('cours_videos/index.html.twig', [
            'controller_name' => 'CoursVideosController',
        ]);
    }
}
