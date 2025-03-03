<?php

namespace App\Controller;

use App\Entity\Affectation;
use App\Repository\AffectationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffectationController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/affectation/calendar', name: 'affectation_calendar')]
    public function calendar(AffectationRepository $affectationRepository): Response
    {
        $affectations = $affectationRepository->findAll();
        $events = [];

        foreach ($affectations as $affectation) {
            $events[] = [
                'id' => $affectation->getId(),
                'title' => $affectation->getEmploye()->getNom() . ' - ' . $affectation->getChantier()->getNom(),
                'start' => $affectation->getDateDebut()->format('Y-m-d'),
                'end' => $affectation->getDateFin()->format('Y-m-d'),
            ];
        }

        return $this->render('affectation/calendar.html.twig', [
            'affectations' => json_encode($events),
        ]);
    }

    #[Route('/affectation/{id}/update-date', name: 'affectation_update_date', methods: ['POST'])]
    public function updateDate(Affectation $affectation, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['date']) || !strtotime($data['date'])) {
            return new JsonResponse(['status' => 'error', 'message' => 'Date invalide'], 400);
        }
        $affectation->setDateAffectationDebut(new \DateTime($data['date']));
        $this->entityManager->flush();

        return new JsonResponse(['status' => 'success']);
    }
}