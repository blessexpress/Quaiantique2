<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesreservationsController extends AbstractController
{
    #[Route('/mes-reservations', name: 'app_mes_reservations')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user_connected = $this->getUser()->getEmail();
        $mes_reservation = $entityManager->getRepository(Reservation::class)->findBy(array('Email' => $user_connected));

       // dd($mes_reservation);
        
        return $this->render('mesreservations/index.html.twig', [
            'reservations' => $mes_reservation,
        ]);
    }

    private function getDoctrine()
    {
    }

    private function getRepository(string $class)
    {
    }
}
