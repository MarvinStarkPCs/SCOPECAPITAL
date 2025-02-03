<?php namespace App\Models;

use CodeIgniter\Model;

class AsignarArticuloModel extends Model
{
    protected $table      = 'asignaciones';
    protected $primaryKey = 'id';

    protected $allowedFields = ['articulo_id', 'de_usuario_id', 'a_usuario_id', 'cantidad_otorgada', 'asignado_en'];

}
