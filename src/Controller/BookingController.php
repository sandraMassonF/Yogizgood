<?php

namespace App\Controller;

use App\Entity\Session;
use App\Repository\BookingRepository;
use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingController extends AbstractController

{
    #[Route('/booking/{session}', name: 'app_booking_details', requirements:['session'=> '\d+'])]
    public function detail( Session $session, SessionRepository $sessionRepository)
    {
        $cours = $sessionRepository->findAll();
        $events = [];
    
        foreach ($cours as $cour) {
            $event = [
                "type" => $cour->getKind()->getType(),
                "start" => $cour->getDate()->format('Y-m-d\TH:i:s'),
                "allDay" => true,
                "description" => $cour->getKind()->getDescription(),
                "kind" => $cour->getKind()->getType(),
                "formated_start" =>  $cour->getDate()->format('d/m/Y à H:i'),
                'booking_url' => $this->generateUrl('app_booking', ['details' => $cour->getDate()->format('Y-m-d')])
                ];
    
            $events[] = $event;
        }
        // dd($cours);
        return $this->render('booking/details.html.twig', ['events'=>$events, 'cours'=>$cours, 'session' => $session]);
    }
#[Route('/booking/{details}', name: 'app_booking')]
public function liste(SessionRepository $sessionRepository)
{
    $cours = $sessionRepository->findAll();

    $events = [];

    foreach ($cours as $cour) {
        $event = [
            "type" => $cour->getKind()->getType(),
            "start" => $cour->getDate()->format('Y-m-d\TH:i:s'),
            "allDay" => true,
            "description" => $cour->getKind()->getDescription(),
            "kind" => $cour->getKind()->getType(),
            "formated_start" =>  $cour->getDate()->format('d/m/Y à H:i'),
            'booking_url' => $this->generateUrl('app_booking', ['details' => $cour->getDate()->format('Y-m-d')])
        ];

        $events[] = $event;
    }
    // dd($cours);
    return $this->render('booking/index.html.twig', ['events'=>$events, 'cours'=>$cours]);
}


    }