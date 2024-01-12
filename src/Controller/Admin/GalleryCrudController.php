<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GalleryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gallery::class;
    }


    public function configureFields(string $pageName): iterable
    {

        return [
            //IdField::new('id'),
            TextField::new('title'),
            ImageField::new('Image')
                ->setBasePath('/assets/img/')
                ->setUploadDir('/public/assets/img/')
                ->setUploadedFileNamePattern('coverAccueil.jpg')
                ->setRequired(true)
        ];

        dd($this);
    }

}
