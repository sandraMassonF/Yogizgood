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
        $cours = $sessionRepository->findAll();

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

    
    #[Route('/new', name: 'app_session_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SessionRepository $sessionRepository): Response
    {
        // Créer une nouvelle instance de l'entité Session
        $session = new Session();

        // Créer le formulaire en utilisant SessionType et l'entité Session
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarder la session dans la base de données
            $sessionRepository->save($session, true);

            // Rediriger vers la liste des sessions avec un code de statut HTTP 303 (SEE OTHER)
            return $this->redirectToRoute('app_session_index', [], Response::HTTP_SEE_OTHER);
        }

        // Rendre la vue Twig 'session/new.html.twig' avec le formulaire et la session
        return $this->renderForm('session/new.html.twig', [
            'session' => $session,
            'form' => $form,
        ]);
    }

    
    #[Route('/{id}', name: 'app_session_show', methods: ['GET'])]
    public function show(Session $session): Response
    {
        // Rendre la vue Twig 'session/show.html.twig' avec la session spécifiée
        return $this->render('session/show.html.twig', [
            'session' => $session,
        ]);
    }
}