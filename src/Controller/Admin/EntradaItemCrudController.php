<?php

namespace App\Controller\Admin;

use App\Entity\EntradaItem;
use App\Controller\Admin\ProductoCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EntradaItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EntradaItem::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addColumn(12),
            IntegerField::new('cantidad', 'Cantidad'),
            AssociationField::new('producto', 'Producto')
                ->setCrudController(ProductoCrudController::class)
                ->setFormTypeOptions([
                    'choice_label' => 'nombre',
                ]),
        ];
    }
    
}
