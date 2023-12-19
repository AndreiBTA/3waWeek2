<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield from [
            IdField::new('id')->onlyOnIndex(),
            ImageField::new('name')
                ->setBasePath('/img')
                ->setUploadDir('public/img')
                ->setFormType(FileUploadType::class),
            //                ->setFormTypeOption('multiple', true)
        ];
    }
}
