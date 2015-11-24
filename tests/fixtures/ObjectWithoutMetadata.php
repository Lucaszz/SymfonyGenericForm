<?php

namespace Lucaszz\SymfonyGenericForm\Tests\fixtures;

class ObjectWithoutMetadata
{
    public $propertyInteger;
    public $propertyString;
    public $propertyDateTime;
    public $propertyUuid;

    public function __construct($propertyInteger, $propertyString, $propertyDateTime, $propertyUuid)
    {
        $this->propertyInteger  = $propertyInteger;
        $this->propertyString   = $propertyString;
        $this->propertyDateTime = $propertyDateTime;
        $this->propertyUuid     = $propertyUuid;
    }
}
