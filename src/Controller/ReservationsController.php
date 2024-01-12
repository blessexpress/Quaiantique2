<?php

namespace App\Controller;


use App\Entity\Reservation;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationsController extends AbstractController
{
    #[Route('/reservations', name: 'app_reservations')]
    public function index(Request $request, EntityManagerInterface $manager): Response
    {

        #recuperation des donnees du formulaire (recuperation du nom,email,telephone personnes,date reservation et l'heure)
        if ($request->request->count() > 0) {
            $name = $request->request->get("nom");
            $email = $request->request->get("email");
            $telephone = $request->request->get("telephone");
            $nbPersonnes = $request->request->get("nombre_personnes");
            $dateReservation =new \DateTime($request->request->get("date_reservation")) ;
            $heureReservation = $request->request->get("heure_reservation");



            $reservation = new Reservation();
            $reservation->setName($name);
            $reservation->setEmail($email);
            $reservation->setTelephone($telephone);
            $reservation->setNombrePersonnes($nbPersonnes);
            $reservation->setDateReservation($dateReservation);
            $reservation->setHeureReservation($heureReservation);
            //$reservation->addUser($this->getUser());
            //dd($reservation);


            if ((empty($heureReservation)) || (empty($dateReservation)) || (empty($nbPersonnes)) || (empty($telephone)) || (empty($email)) || (empty($name)) ) {
                $this->addFlash(
                    "danger",
                    "Le champ de reservation ne peut pas etre vide."
                );
                return $this->redirectToRoute('app_default');
            }
            else {
                $manager->persist($reservation);
                $manager->flush();

                $this->addFlash(
                    "success",
                    "Votre inscription a bien été prise en compte."
                );
                return $this->redirectToRoute('app_default');
            }


            #dd($reservation);



            #dd($dateReservation);
        }
        return $this->render('reservations/index.html.twig', [
            'controller_name' => 'ReservationsController',
        ]);
    }

}

//creer une page mesreservation.twig dans laquelle on doit afficher toutes les reservation de l'utilisateur connecté

