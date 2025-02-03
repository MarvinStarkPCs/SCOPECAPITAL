<?php

namespace App\Models;

use CodeIgniter\Model;

class MovimientosModel extends Model
{
    protected $table = 'movimientos';
    protected $primaryKey = 'id';

    protected $allowedFields = ['articulo_id', 'tipo', 'cantidad', 'fecha'];

    // Puedes agregar reglas de validación si es necesario
}
