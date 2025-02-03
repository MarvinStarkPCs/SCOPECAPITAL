<?php namespace App\Models;

use CodeIgniter\Model;

class TrasladoModel extends Model
{
    protected $table = 'traslados';
    protected $primaryKey = 'id';
    protected $allowedFields = ['articulo_id', 'de_ubicacion_id', 'a_ubicacion_id', 'trasladado_por', 'trasladado_en'];
}
