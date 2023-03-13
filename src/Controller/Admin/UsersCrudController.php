<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersCrudController extends AbstractCrudController
{

    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct( UserPasswordHasherInterface $passwordEncoder ) {
        $this->passwordEncoder = $passwordEncoder;
    }


    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    public function configureFields( string $pageName ): iterable {
        yield FormField::addPanel( 'User data' )->setIcon( 'fa fa-user' );
        yield TextField::new( 'username' )->onlyWhenUpdating()->setDisabled();
        yield TextField::new( 'username' )->onlyWhenCreating();
        yield TextField::new( 'username' )->onlyOnIndex();
        yield TextField::new( 'firstname' )->setRequired( true );
        yield TextField::new( 'lastname' )->setRequired( true );
        $roles = [ 'ROLE_ADMIN', 'ROLE_TEACHER', 'ROLE_STUDENT' ];
        yield AssociationField::new('instruments')
            ->setFormTypeOption('by_reference', false)
            ->autocomplete();
        yield ChoiceField::new( 'roles' )
                         ->setChoices( array_combine( $roles, $roles ) )
                         ->allowMultipleChoices()
                         ->renderAsBadges();
        yield FormField::addPanel( 'Change password' )->setIcon( 'fa fa-key' );
        yield Field::new( 'plainPassword', 'New password' )->onlyWhenCreating()->setRequired( true )
                   ->setFormType( RepeatedType::class )
                   ->setFormTypeOptions( [
                       'type'            => PasswordType::class,
                       'first_options'   => [ 'label' => 'New password' ],
                       'second_options'  => [ 'label' => 'Repeat password' ],
                       'error_bubbling'  => true,
                       'invalid_message' => 'The password fields do not match.',
                   ] );
        yield Field::new( 'plainPassword', 'New password' )->onlyWhenUpdating()->setRequired( false )
                   ->setFormType( RepeatedType::class )
                   ->setFormTypeOptions( [
                       'type'            => PasswordType::class,
                       'first_options'   => [ 'label' => 'New password' ],
                       'second_options'  => [ 'label' => 'Repeat password' ],
                       'error_bubbling'  => true,
                       'invalid_message' => 'The password fields do not match.',
                   ] );
    }
    
    public function createEditFormBuilder( EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context ): FormBuilderInterface {
        //$plainPassword = $entityDto->getInstance()?->getPassword();
        $formBuilder   = parent::createEditFormBuilder( $entityDto, $formOptions, $context );
        $this->addEncodePasswordEventListener( $formBuilder );
        
        return $formBuilder;
    }

    public function createNewFormBuilder( EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context ): FormBuilderInterface {
        $formBuilder = parent::createNewFormBuilder( $entityDto, $formOptions, $context );
        $this->addEncodePasswordEventListener( $formBuilder );

        return $formBuilder;
    }

    protected function addEncodePasswordEventListener( FormBuilderInterface $formBuilder ): void {
        
        $formBuilder->addEventListener( FormEvents::SUBMIT, function ( FormEvent $event ) {
            /** @var Users $user */
            $user = $event->getData();
            if ( $user->getPlainPassword() !== null ) {
                $user->setPassword( $this->passwordEncoder->hashPassword( $user, $user->getPlainPassword() ) );
            }
        } );
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
