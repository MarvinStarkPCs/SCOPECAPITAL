<?php

namespace App\Models;

use CodeIgniter\Model;

class AsignacionesModel extends Model
{
    protected $table = 'asignaciones'; // Define la tabla principal
    protected $primaryKey = 'id'; // Llave primaria de la tabla

    // Método para obtener la información de asignaciones con usuarios y perfiles
    public function obtenerAsignaciones()
    {
        $sql = "
        SELECT
            a.id AS asignacion_id,
            CONCAT(CONVERT(ar.nombre USING utf8mb4), ' (', CONVERT(ar.marca USING utf8mb4), ') -', CONVERT(ar.cod_institucional USING utf8mb4)) AS articulo,
            CONCAT(CONVERT(ua.nombres USING utf8mb4), ' ', CONVERT(ua.apellidos USING utf8mb4), ' - ', CONVERT(pa.nombre USING utf8mb4)) AS usuario_asignador,
            CONCAT(CONVERT(ur.nombres USING utf8mb4), ' ', CONVERT(ur.apellidos USING utf8mb4), ' - ', CONVERT(pr.nombre USING utf8mb4)) AS usuario_receptor,
            a.cantidad_otorgada,
            a.asignado_en
        FROM
            asignaciones a
            INNER JOIN articulos ar ON a.articulo_id = ar.id
            INNER JOIN usuarios ua ON a.de_usuario_id = ua.id
            INNER JOIN usuarios ur ON a.a_usuario_id = ur.id
            INNER JOIN perfiles pa ON pa.id = ua.perfil_id
            INNER JOIN perfiles pr ON pr.id = ur.perfil_id
        ";

        // Ejecutar la consulta y obtener los resultados
        $query = $this->db->query($sql);

        return $query->getResult();
    }
}
