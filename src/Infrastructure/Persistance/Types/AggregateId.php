<?php

namespace Dieselnet\Infrastructure\Persistance\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class AggregateId extends Type
{
    const NAME = 'AggregateId';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {

    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return \Dieselnet\Domain\Kernel\AggregateId::fromString((string) $value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string) $value;
    }

    public function getName()
    {
        return self::NAME;
    }
}
