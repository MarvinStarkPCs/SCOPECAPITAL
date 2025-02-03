<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcedenciasModel extends Model
{
    protected $table = 'procedencias';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nombre','nit_o_cc','direccion','telefono','representante','correo'];

    // Opcional: Si usas timestamps en tu tabla
    protected $useTimestamps = false;

    // Opcional: Configura el formato de fecha si usas timestamps
    // protected $dateFormat = 'datetime';
}
