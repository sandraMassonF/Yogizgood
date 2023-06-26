<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserprofileController extends AbstractController
{
    #[Route('/userprofile', name: 'app_userprofile')]
    public function index(): Response
    {
        return $this->render('userprofile/index.html.twig', [
            'controller_name' => 'UserprofileController',
        ]);
    }

    #[Route('/userprofile/edit', name: 'app_userprofile_edit')]
    public function edit(): Response
    {

        return $this->render('userprofile/edit.html.twig', [
            'controller_name' => 'UserprofileController',
        ]);
    }

    #[Route('/userprofile/delete', name: 'app_userprofile_delete')]
    public function delete(): Response
    {

        return $this->redirectToRoute('app_home');
    }

}