<?php

namespace Dieselnet\Domain;

class Assert
{
    public static function notEmpty($value)
    {
        if (empty($value)) {
            throw new DomainException('Invalid value');
        }
    }
}
