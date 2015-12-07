<?php

namespace Lucaszz\SymfonyFormGenerator\Form\Type;

use Lucaszz\SymfonyFormGenerator\Form\DataTransformer\UuidToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UuidType extends AbstractType
{
    /** {@inheritdoc} */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new UuidToStringTransformer());
    }

    /** {@inheritdoc} */
    public function getParent()
    {
        return 'text';
    }

    /** {@inheritdoc} */
    public function getName()
    {
        return 'generator_uuid';
    }
}
