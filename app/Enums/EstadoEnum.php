<?php

namespace App\Enums;

class EstadoEnum
{
    const ATIVO = 'ativo';
    const DESATIVADO = 'desativado';

    public static function getConstants()
    {
        $reflectionClass = new \ReflectionClass(self::class);
        return $reflectionClass->getConstants();
    }
}
