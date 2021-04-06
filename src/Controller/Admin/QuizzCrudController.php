<?php

namespace App\Controller\Admin;

use App\Entity\Quizz;
use App\Form\QuestionType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuizzCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quizz::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            CollectionField::new('questions')
                ->setEntryType(QuestionType::class)
                ->setCustomOption('by_reference', false),
        ];
    }
}
