<?php

namespace App\Controller\Admin;

use App\Entity\Producto;
use App\Entity\Categoria;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use App\Controller\Admin\CategoriaCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Producto::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            FormField::addColumn(12),
            TextField::new('nombre'),
            SlugField::new('slug')
                ->setTargetFieldName('nombre'),
            TextField::new('descripcion'),
            NumberField::new('precio')
                ->setNumDecimals(2),
            IntegerField::new('stock'),
            AssociationField::new('categorias', 'Categorias')
                ->setCrudController(CategoryCrudController::class)
                ->setFormTypeOptions([
                    'choice_label' => 'nombre',
                ]),
        ];
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     return $actions
    //         // ...
    //         ->add(Crud::PAGE_INDEX, Action::DETAIL)
    //         ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
    //     ;
    // }
}
