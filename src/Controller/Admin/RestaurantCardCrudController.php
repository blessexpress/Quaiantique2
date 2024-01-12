<?php

namespace App\Controller\Admin;

use App\Entity\RestaurantCard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RestaurantCardCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RestaurantCard::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('title'),
            MoneyField::new('price')->setCurrency('EUR'),
            TextField::new('category'),
            TextEditorField::new('description'),
        ];
    }

}
