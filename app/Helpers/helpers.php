<?php
namespace App\Helpers;
class helpers
{
    // Función para generar el serial aleatorio
    public static function generateRandomString($length = 6)
    {
        // Prefijo fijo para el serial
        $prefix = 'SIBI';

        // Caracteres permitidos para el serial (en este caso solo números)
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        // Generar una cadena aleatoria de números del largo especificado
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        // Retornar el serial completo
        return $prefix . $randomString;
    }
};  