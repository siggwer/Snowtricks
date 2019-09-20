<?php


namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

/**
 * Class VideoType
 *
 * @package App\Form
 */
class VideoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     *
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'url',
                UrlType::class,
                [
                'attr' => array(
                    'placeholder' => 'Insérer le lien'
                )
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
            'data_class' => Video::class,
            ]
        );
    }
}
