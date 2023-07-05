<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Controller\SessionController;
use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/session')]
class SessionController extends AbstractController
{
    #[Route('/', name: 'app_session_index', methods: ['GET'])]
    public function liste(SessionRepository $sessionRepository)
    {
        // Récupérer tous les cours de la base de données
        $cours = $sessionRepository->getNext();

        // Créer un tableau vide pour stocker les événements
        $events = [];

        // Parcourir chaque cours et créer un événement correspondant
        foreach ($cours as $cour) {
            $event = [
                "type" => $cour->getKind()->getType(),
                "start" => $cour->getDate()->format('Y-m-d\TH:i:s'),
                "allDay" => true,
                "description" => $cour->getKind()->getDescription(),
                "kind" => $cour->getKind()->getType(),
                "formated_start" => $cour->getDate()->format('d/m/Y à H:i'),
                'booking_url' => $this->generateUrl('app_booking', ['details' => $cour->getDate()->format('Y-m-d')])
            ];

            // Ajouter l'événement au tableau des événements
            $events[] = $event;
        }

        // Rendre la vue Twig 'session/index.html.twig' avec les données des événements et des cours
        return $this->render('session/index.html.twig', ['events' => $events, 'cours' => $cours]);
    }
}