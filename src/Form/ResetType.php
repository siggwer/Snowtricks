<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use App\Entity\User;

/**
 * Class ResetType.
 */
class ResetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
                        ),
                    ]
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
            ]
        );
    }
}
