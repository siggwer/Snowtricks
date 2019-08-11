<?php


namespace App\Form;


use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder,array $options){
        $builder
            ->add('path', HiddenType::class)
            ->add('uploadedFile', FileType::class, [
                'label' => false,
                'required' => false
            ])
            ->add('alt', TextType::class,  [
                'label' => 'texte alternatif',
                'required' => false
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefault("data_class", Picture::class);
    }
}