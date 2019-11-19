<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RegistrationFormType.
 */
class RegistrationFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'username',
                TextType::class,
                [
                'attr' => array(
                    'placeholder' => 'Votre pseudo',
                ),
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                'attr' => array(
                    'placeholder' => 'Votre email',
                ),
                ]
            )
            ->add(
                'plainPassword',
                RepeatedType::class,
                [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe',
                    'attr' => array(
                    'placeholder' => 'Votre mot de passe',
                ), ],
                'second_options' => ['label' => 'Répéter votre mot de passe',
                    'attr' => array(
                    'placeholder' => 'Répetez votre mot de passe',
                ), ],
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
            'data_class' => User::class,
            ]
        );
    }
}
