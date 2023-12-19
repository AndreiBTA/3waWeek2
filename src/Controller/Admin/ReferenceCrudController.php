<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Reference;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReferenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reference::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield from [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name', 'Product reference'),
            AssociationField::new('product')->autocomplete(),
        ];
    }
}
