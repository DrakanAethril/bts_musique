<?php

namespace App\Controller\Admin;

use App\Entity\LessonsSlots;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class LessonsSlotsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LessonsSlots::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new( 'name' );
        yield IntegerField::new( 'day' );
        yield TimeField::new( 'hour_start' );
        yield TimeField::new( 'hour_end' );
        yield AssociationField::new('users')
            ->setFormTypeOption('by_reference', false)
            ->autocomplete();
        yield BooleanField::new( 'active' );
    }
    
}
