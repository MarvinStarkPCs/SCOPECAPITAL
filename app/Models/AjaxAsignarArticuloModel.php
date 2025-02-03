<?php

namespace App\Models;

use CodeIgniter\Model;

class AjaxAsignarArticuloModel extends Model
{
    protected $table = 'inventario_anual';
    protected $primaryKey = 'id';


    public function getInventarioConValorTotal($serial, $idUbicacion)
    {
        $builder = $this->db->table('inventario_anual ia');
        $builder->select([
            'ia.id AS id_inventario',
            'a.id AS id_articulo',
            'a.nombre AS nombre_articulo',
            'a.modelo AS modelo_articulo',
            'a.descripcion AS descripcion_articulo',
            "CASE WHEN ia.serial IS NULL THEN 'NO APLICA' ELSE ia.serial END AS serial",
            'ia.cod_institucional',
            'm.nombre AS nombre_marca',
            'e.nombre AS nombre_estado',
            'p.nombre AS nombre_procedencia',
            's.nombre AS nombre_sede',
            'u.nombre AS nombre_ubicacion',
            'ia.fecha_adquisicion',
            'ia.fecha_ingreso',
            'a.valor_unitario',
            '(a.valor_unitario * ia.stock_inicio) AS valor_total',
            'ia.stock_inicio',
            'ia.stock_final'
        ]);

        $builder->join('sibi.articulos a', 'ia.articulo_id = a.id');
        $builder->join('sibi.marcas m', 'a.marca_id = m.id');
        $builder->join('sibi.categorias c', 'a.categoria_id = c.id');
        $builder->join('sibi.ubicaciones u', 'ia.ubicacion_id = u.id');
        $builder->join('sibi.sedes s', 'u.sede_id = s.id');
        $builder->join('sibi.estados e', 'ia.estado_id = e.id');
        $builder->join('sibi.procedencias p', 'ia.procedencia_id = p.id');

        // Filtra por el serial y la ubicación proporcionados
        $builder->where('ia.serial', $serial);
        $builder->where('ia.ubicacion_id', $idUbicacion); // Validar ubicación

        // Excluye artículos con estado "DADO DE BAJA" y ubicaciones "Dados de Bajas"
        $builder->where('e.nombre !=', 'DADO DE BAJA');
        $builder->where('u.nombre !=', 'DADOS DE BAJAS');

        // Ordena por nombre de artículo y fecha de ingreso
        $builder->orderBy('a.nombre', 'ASC');
        $builder->orderBy('ia.fecha_ingreso', 'DESC');

        $query = $builder->get();

        return $query->getResult();
    }


public function getInventarioxUbicaion($idUbicacion)
{
    $builder = $this->db->table('inventario_anual ia');
    $builder->select([
        'ia.id AS id_inventario',
        'a.id AS id_articulo',
        'a.nombre AS nombre_articulo',
        'a.modelo AS modelo_articulo',
        'a.descripcion AS descripcion_articulo',
        "CASE WHEN ia.serial IS NULL THEN 'NO APLICA' ELSE ia.serial END AS serial",
        'ia.cod_institucional',
        'm.nombre AS nombre_marca',
        'e.nombre AS nombre_estado',
        'p.nombre AS nombre_procedencia',
        's.nombre AS nombre_sede',
        'u.nombre AS nombre_ubicacion',
        'ia.fecha_adquisicion',
        'ia.fecha_ingreso',
        'a.valor_unitario',
        '(a.valor_unitario * ia.stock_inicio) AS valor_total',
        'ia.stock_inicio',
        'ia.stock_final'
    ]);

    $builder->join('sibi.articulos a', 'ia.articulo_id = a.id');
    $builder->join('sibi.marcas m', 'a.marca_id = m.id');
    $builder->join('sibi.categorias c', 'a.categoria_id = c.id');
    $builder->join('sibi.ubicaciones u', 'ia.ubicacion_id = u.id');
    $builder->join('sibi.sedes s', 'u.sede_id = s.id');
    $builder->join('sibi.estados e', 'ia.estado_id = e.id');
    $builder->join('sibi.procedencias p', 'ia.procedencia_id = p.id');

    // Filtra por el serial y la ubicación proporcionados
    $builder->where('ia.ubicacion_id', $idUbicacion); // Validar ubicación

    // Excluye artículos con estado "DADO DE BAJA" y ubicaciones "Dados de Bajas"
    $builder->where('e.nombre !=', 'DADO DE BAJA');
    $builder->where('u.nombre !=', 'DADOS DE BAJAS');

    // Ordena por nombre de artículo y fecha de ingreso
    $builder->orderBy('a.nombre', 'ASC');
    $builder->orderBy('ia.fecha_ingreso', 'DESC');

    $query = $builder->get();

    return $query->getResult();
}
//    public function getInventarioxEstados($idArticulo) {
//        $sql = "SELECT e.id, e.nombre, ia.articulo_id,ia.stock_inicio FROM inventario_anual ia
//    INNER JOIN sibi.estados e on ia.estado_id = e.id
//WHERE  ia.id  = ?";
//
//        $query = $this->db->query($sql, [$idArticulo]);
//        return $query->getResult();
//    }


}
