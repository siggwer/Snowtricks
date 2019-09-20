<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Class PictureType
 *
 * @package App\Form
 */
class PictureType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     *
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('path', HiddenType::class)
            ->add(
                'uploadedFile',
                null,
                [
                'label' => false,
                'required' => false,

                ]
            )
            ->add(
                'alt',
                null,
                [
                'label' => false,
                'required' => false,
                'attr' => array(
                    'placeholder' => 'texte alternatif'
                )
                ]
            )
            ->addEventListener(
                FormEvents::SUBMIT,
                function (formEvent $event) {
                    $picture = $event->getData();
                    if ($picture->getUploadedFile() !== null) {
                        $picture->setPath(null);
                    }
                }
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', Picture::class);
    }
}
