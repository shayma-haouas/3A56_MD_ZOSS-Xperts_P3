<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsernewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('lastname')
            ->add('email')
            ->add('number')
            ->add('password', PasswordType::class)
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'ROLE_FOURNISSEUR' => 'ROLE_FOURNISSEUR',
                    'ROLE_CLIENT' => 'ROLE_CLIENT',
                ],
                'multiple' => true,
                'required' => true 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
