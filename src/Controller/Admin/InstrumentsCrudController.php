<?php

namespace App\Controller\Admin;

use App\Entity\Instruments;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InstrumentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Instruments::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
            yield TextField::new( 'name' );
            yield BooleanField::new( 'active' );
            yield AssociationField::new('users')
            ->setFormTypeOption('by_reference', false)
            ->autocomplete();
    }
    
}
