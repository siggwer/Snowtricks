<?php


namespace App\Form;

use App\Entity\Category;
use App\Entity\Trick;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TrickType
 *
 * @package App\Form
 */
class TrickType extends AbstractType
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
                'name',
                TextType::class,
                [
                'label' => 'Nom du trick',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Titre'
                )
                ]
            )
            ->add(
                'category',
                EntityType::class,
                [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Indiquez la catégorie',
                'required' => true
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                'label' => 'Indiquez une description',
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Description'
                )
                ]
            )
            ->add(
                'pictureOnFront',
                PictureType::class,
                [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Image principale'
                )
                ]
            )
            ->add(
                'pictures',
                CollectionType::class,
                [
                'label' => false,
                'entry_type' => PictureType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
                ]
            )
            ->add(
                'videos',
                CollectionType::class,
                [
                'label' => false,
                'entry_type' => VideoType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('data_class', Trick::class);
    }
}
