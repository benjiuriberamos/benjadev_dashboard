<?php

namespace App\Controller\Admin;

use App\Entity\Entrada;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EntradaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Entrada::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addColumn(12),
            IntegerField::new('user_id'),
            DateTimeField::new('fechaEntrada', 'Fecha de ingreso de productos.'),
            TextField::new('ocurrencia'),
            CollectionField::new('entradaItems', 'Productos')
                ->useEntryCrudForm(EntradaItemCrudController::class)
                ->renderExpanded()
                ->showEntryLabel(false)
                ->setEntryIsComplex()
                ,
        ];
    }
}
