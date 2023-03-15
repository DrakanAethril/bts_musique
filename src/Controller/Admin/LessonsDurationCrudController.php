<?php

namespace App\Controller\Admin;

use App\Entity\LessonsDuration;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LessonsDurationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LessonsDuration::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
