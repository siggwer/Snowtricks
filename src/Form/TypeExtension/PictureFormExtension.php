<?php

namespace App\Form\TypeExtension;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PictureFormExtension
 *
 * @package App\Form\TypeExtension
 *
 */
class PictureFormExtension implements FormTypeExtensionInterface
{
    /**
     * Builds the form.
     *
     * This method is called after the extended type has built the form to
     * further modify it.
     *
     * @see FormTypeInterface::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // TODO: Implement buildForm() method.
    }

    /**
     * Builds the view.
     *
     * This method is called after the extended type has built the view to
     * further modify it.
     *
     * @see FormTypeInterface::buildView()
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        // TODO: Implement buildView() method.
    }

    /**
     * Finishes the view.
     *
     * This method is called after the extended type has finished the view to
     * further modify it.
     *
     * @see FormTypeInterface::finishView()
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        // TODO: Implement finishView() method.
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        // TODO: Implement configureOptions() method.
    }

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     *
     * @deprecated since Symfony 4.2, use getExtendedTypes() instead.
     */
    public function getExtendedType()
    {
        return '';
    }

    public static function getExtendedTypes(): iterable
    {
        return [FileType::class];
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method iterable getExtendedTypes()
    }
}