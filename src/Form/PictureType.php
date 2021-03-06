<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use App\Entity\Picture;

/**
 * Class PictureType.
 */
class PictureType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add(
                'uploadedFile',
                FileType::class,
                [
                'label' => false,
                'required' => false,
                'constraints' => [
                    new Image(
                        [
                        'maxWidth' => $options['width'],
                        'maxHeight' => $options['height'],
                        ]
                    ),
                ],
                ]
            )
            ->add(
                'alt',
                null,
                [
                'label' => false,
                'required' => false,
                ]
            )
            ->addEventListener(
                FormEvents::SUBMIT,
                function (formEvent $event) {
                    $picture = $event->getData();
                    if (null !== $picture->getUploadedFile()) {
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
        $resolver->setDefaults(
            [
            'data_class' => Picture::class,
            'width' => 400,
            'height' => 400,
            ]
        );
    }
}
