<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\User;
use Symfony\Component\Validator\Constraints\Image;

/**
 * Class AvatarType
 *
 * @package App\Form
 */
class AvatarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     *
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('avatar', PictureType::class, [
              'label' => 'Mon nouvel avatar',
                'attr' => array(
                  'placeholder' => 'Votre avatar'),
                'constraints' => [
                    new Image([
                        'maxSize' => '0214000K'
                    ])
                ]
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => 'avatar'
        ]);
    }
}