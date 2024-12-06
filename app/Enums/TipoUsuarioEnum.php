<?php

namespace App\Enums;

class TipoUsuarioEnum
{
    const ESTUDANTE = 'estudante';
    const PROFESSOR = 'professor';

    public static function getConstants()
    {
        $reflectionClass = new \ReflectionClass(self::class);
        return $reflectionClass->getConstants();
    }
}
