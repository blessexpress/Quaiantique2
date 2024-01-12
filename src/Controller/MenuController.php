<?php

namespace App\Controller;

use App\Entity\Menu;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(EntityManagerInterface $em): Response
    {

        $menus = $em->getRepository(Menu::class) ->findAll();

        return $this->render('menu/index.html.twig', [
            'controller_name' => 'Menu',
            'menus' => $menus,
        ]);
    }
}
