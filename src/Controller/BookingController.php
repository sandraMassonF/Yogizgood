<?php

namespace App\Controller;

use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingController extends AbstractController
// {
//     #[Route('/booking/{date}', name: 'app_booking')]
//     public function index(SessionRepository $repo, $date): Response
//     {
//         $sessions = $repo->getByDate($date);
//         return $this->render('booking/index.html.twig', [
//             'sessions' => $sessions,
//         ]);
//     }

//     public function liste(SessionRepository $sessionRepository)
//     {
//         $cours = $sessionRepository->findAll();

//         $events = [];

//         foreach ($cours as $cour) {
//             $event = [
//                 "type" => $cour->getKind()->getType(),
//                 "start" => $cour->getDate()->format('Y-m-d\TH:i:s'),
//                 "allDay" => true,
//                 "description" => $cour->getKind()->getDescription(),
//                 "kind" => $cour->getKind()->getType(),
//                 "formated_start" =>  $cour->getDate()->format('d/m/Y à H:i'),
//                 'booking_url' => $this->generateUrl('app_booking', ['date' => $cour->getDate()->format('Y-m-d')])
//                 ];

//             $events[] = $event;
//         }
//         // dd($events);

//         return $this->render('session/index.html.twig', ['events'=>$events, 'cours'=>$cours]);

//     }
// }

{
#[Route('/booking/{date}', name: 'app_booking')]
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
            'booking_url' => $this->generateUrl('app_booking', ['date' => $cour->getDate()->format('Y-m-d')])
        ];

        $events[] = $event;
    }
    // dd($cours);
    return $this->render('booking/index.html.twig', ['events'=>$events, 'cours'=>$cours]);
}
}
