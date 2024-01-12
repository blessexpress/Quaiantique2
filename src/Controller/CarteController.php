<?php

namespace App\Controller;

use App\Entity\RestaurantCard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[Route('/carte', name: 'app_carte')]
    public function index(EntityManagerInterface $em): Response
    {

        $card = $em->getRepository(RestaurantCard::class)->findAll();

        return $this->render('carte/index.html.twig', [
            'controller_name' => 'CarteController',
            'RestaurantCard' => $card,
        ]);
    }
}
