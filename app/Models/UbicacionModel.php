<?php

namespace App\Models;

use CodeIgniter\Model;

class UbicacionModel extends Model
{
    protected $table = 'ubicaciones';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'sede_id'];
    protected $returnType = 'array';

    /**
     * Obtiene las ubicaciones ordenadas por el nombre de la sede.
     */
    public function getUbicacionesOrdenadasPorSede()
    {
        return $this->select('ubicaciones.id, ubicaciones.nombre AS nombre_ubicacion, ubicaciones.sede_id, sedes.nombre AS nombre_sede')
            ->join('sedes', 'ubicaciones.sede_id = sedes.id')
            ->orderBy('sedes.nombre', 'ASC')
            ->findAll();
    }
}
