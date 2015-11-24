<?php

namespace Lucaszz\SymfonyGenericForm\Form\DataTransformer;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class UuidToStringTransformer implements DataTransformerInterface
{
    /** {@inheritdoc} */
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        if (!$value instanceof Uuid) {
            throw new TransformationFailedException('Expected a \Ramsey\Uuid\Uuid');
        }

        return $value->toString();
    }

    /** {@inheritdoc} */
    public function reverseTransform($value)
    {
        try {
            $uuid = Uuid::fromString($value);
        } catch (\InvalidArgumentException $e) {
            throw new TransformationFailedException();
        }

        return $uuid;
    }
}
