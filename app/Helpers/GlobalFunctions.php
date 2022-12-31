<?php

namespace App\Helpers;

class GlobalFunctions
{
    public static function requiredMessage($value)
    {
        return "El campo $value es obligatorio.";
    }

    public static function formatMessage($value)
    {
        return "El campo $value tiene un formato incorrecto.";
    }

    public static function uniqueMessage($value)
    {
        return "El campo $value ya fue registrado.";
    }
}
