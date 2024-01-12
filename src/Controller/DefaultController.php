<?php

namespace App\Controller;

use App\Entity\Gallery;
use App\Entity\RestaurantCard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(EntityManagerInterface $em): Response
    {
        $userRole = '';
        $gallery = $em->getRepository(Gallery::class)->findAll();

        //dd($gallery);

        //redirige le user connected vers la page admin si le user est un admin
        $userConnected = $this->getUser();
        if($userConnected){
            $roles = $userConnected->getRoles();

            foreach ($roles as $role) {
                if ($role == "ROLE_ADMIN"){
                    $userRole = $role;
                }
            }


            if ($userRole=="ROLE_ADMIN") {
                //dd($userRole);
               return $this->redirectToRoute('admin');

         }
        }
        return $this->render('default/index.html.twig', [
            'controller_name' => 'ayoub',
            'gallery' => $gallery,
        ]);
    }
}
