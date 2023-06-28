<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Repository\BookingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/profile', name: 'app_user', methods: ['GET'])]
    public function show(BookingRepository $bookingRepository):Response
    {
        $bookings = $bookingRepository->findAll();
        $booking_users = [];

        foreach ($bookings as $booking) {
            $booking_user = [
                "type" => $booking->getSession()->getKind()->getType(),
                "start" => $booking->getSession()->getDate()->format('Y-m-d\TH:i:s'),
                "description" => $booking->getSession()->getKind()->getDescription(),
                "kind" => $booking->getSession()->getKind()->getType(),
                "formated_start" => $booking->getSession()->getDate()->format('d/m/Y à H:i'),
            ];
                        
            $booking_users [] = $booking_user ;
        }
            
            $user = $this->getUser();
            return $this->render('user/show.html.twig', [
                'user' => $user,
                'bookings' => $booking_users
            ]);
    }


    #[Route('/profile/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
