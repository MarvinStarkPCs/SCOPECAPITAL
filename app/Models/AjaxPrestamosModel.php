<?php

namespace App\Models;

use CodeIgniter\Model;
class AjaxPrestamosModel extends Model
{
    protected $table = 'inventario_anual';
    public function obtenerEstadoUbicacionPorArticulo($articuloId)
    {
        return $this->db->table($this->table)
            ->select('e.id AS id_estado, e.nombre AS estado, u.id AS id_ubicacion, u.nombre AS ubicacion, s.nombre AS sede, p.nombre AS procedencia, inventario_anual.stock_inicio')
            ->join('sibi.articulos a', 'inventario_anual.articulo_id = a.id')
            ->join('sibi.estados e', 'inventario_anual.estado_id = e.id')
            ->join('sibi.ubicaciones u', 'inventario_anual.ubicacion_id = u.id')
            ->join('sibi.sedes s', 'u.sede_id = s.id')
            ->join('sibi.procedencias p', 'inventario_anual.procedencia_id = p.id')
            ->where('inventario_anual.articulo_id', $articuloId)
            ->where('u.nombre !=', 'En Préstamo') // Excluir ubicaciones con el nombre 'En Préstamo'
            ->where('e.nombre !=', 'DADO DE BAJA') // Excluir artículos en estado 'DADO DE BAJA'
            ->where('YEAR(inventario_anual.fecha)', date('Y')) // Filtrar por el año actual
            ->get()
            ->getResultArray();
    }

}
