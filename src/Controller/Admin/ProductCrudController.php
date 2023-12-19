<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield from [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name', 'Product name'),
            TextEditorField::new('description'),
            MoneyField::new('price', 'Price')->setCurrency('EUR'),
            AssociationField::new('category')->autocomplete(),
            AssociationField::new('distributeurs')->autocomplete(),
            AssociationField::new('reference')->renderAsEmbeddedForm(),
            ImageField::new('photos[0]', 'Images')
                ->onlyOnIndex()
                ->setBasePath('/img')
                ->setUploadDir('/public/img'),
            CollectionField::new('photos')
                ->onlyOnForms()
                ->useEntryCrudForm(PhotoCrudController::class),
            DateTimeField::new('createdAt')->onlyOnIndex(),
            DateTimeField::new('updatedAt')->onlyOnIndex(),
        ];
    }
}
