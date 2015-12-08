<?php

use Lucaszz\SymfonyFormGenerator\Form\Type\GeneratorFormType;
use Lucaszz\SymfonyFormGenerator\ObjectWithMixedMetadata;
use Symfony\Component\Form\Forms;

Forms::createFormFactory()->createBuilder()
    ->create('form', new GeneratorFormType(ObjectWithMixedMetadata::class))
    ->add('propertyBoolean', 'checkbox')
    ->add('propertyArray', 'generator_array')
    ->add('propertyInteger', 'integer')
    ->add('propertyDateTime', 'generator_datetime')
    ->add('propertyUndefined', 'generator_string');
