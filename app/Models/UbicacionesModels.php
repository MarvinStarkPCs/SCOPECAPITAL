<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DatabaseException;

class UbicacionesModels extends Model
{
    protected $table = 'ubicaciones'; // La tabla con la que estás trabajando
    protected $primaryKey = 'id'; // La clave primaria en la tabla
    protected $allowedFields = ['nombre', 'sede_id']; // Campos permitidos

    public function getUbicacionesWithSedes()
    {
        try {
            // Construir la consulta
            $builder = $this->db->table($this->table . ' u');
            $builder->select('u.id as id_ubicacion, u.nombre as nombre_ubicacion, s.id as id_sede, s.nombre as nombre_sede');
            $builder->join('sedes s', 'u.sede_id = s.id', 'inner'); // Eliminamos el prefijo 'sibi.'

            // Excluir ubicaciones con id 1 y 3
            $builder->whereNotIn('u.id', [1, 3]);

            // Ejecutar la consulta y devolver los resultados
            return $builder->get()->getResult();
        } catch (DatabaseException $e) {
            // Registrar y mostrar errores para diagnóstico
            log_message('error', 'Error en la consulta de ubicaciones con sedes: ' . $e->getMessage());
            return null;
        }
    }
}
