<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Distributeur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DistributeurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Distributeur::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield from [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name', 'Distributeur\'s name'),
            AssociationField::new('products')->autocomplete(),
        ];
    }
}
