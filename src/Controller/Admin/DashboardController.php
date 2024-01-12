<?php

namespace App\Controller\Admin;

//use App\Entity\Carte;
use App\Entity\Gallery;
use App\Entity\Menu;
use App\Entity\RestaurantCard;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $userConnected = $this->getUser();
        if($userConnected){
            $roles = $userConnected->getRoles();

            foreach ($roles as $role) {
                if ($role == "ROLE_ADMIN"){
                    $userRole = $role;
                }
            }

            if(!$userRole){
                //dd($role);
                return $this->redirectToRoute('app_default');
            }

        } else {
            return $this->redirectToRoute('app_default');
        }
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Quaiantique administration')
            ->renderContentMaximized();

    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home' );
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Gallery', 'fa fa-picture-o', Gallery::class);
        yield MenuItem::linkToCrud('RestaurantCard', 'fa-solid fa-burger', RestaurantCard::class);
        yield MenuItem::linkToCrud('Menu',"fa-solid fa-bars", Menu::class);

    }
}
