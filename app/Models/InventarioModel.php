<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarioModel extends Model
{
    protected $table = 'inventario_anual'; // Aunque no se usa directamente, sigue siendo importante definirla
    protected $primaryKey = 'id'; // Cambia esto si tienes una clave primaria en la tabla `inventario_anual`

    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    // Puedes definir los campos que se pueden actualizar si lo necesitas

    protected $allowedFields = [
        'cod_institucional',
        'serial',
        'articulo_id',
        'ubicacion_id',
        'estado_id',
        'procedencia_id',
        'stock_inicio',
        'stock_final'
    ];
    public function getInventarioConValorTotal()
    {
        $currentYear = date('Y'); // Año actual
    
        $builder = $this->db->table('inventario_anual ia');
        $builder->select([
            'ia.id AS id_inventario',
            'a.id AS id_articulo',
            'a.nombre AS nombre_articulo',
            'a.descripcion AS descripcion_articulo',
            'c.nombre AS categoria',
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
    
        $builder->join('articulos a', 'ia.articulo_id = a.id');
        $builder->join('marcas m', 'a.marca_id = m.id');
        $builder->join('categorias c', 'a.categoria_id = c.id');
        $builder->join('ubicaciones u', 'ia.ubicacion_id = u.id');
        $builder->join('sedes s', 'u.sede_id = s.id');
        $builder->join('estados e', 'ia.estado_id = e.id');
        $builder->join('procedencias p', 'ia.procedencia_id = p.id');
    
        // Excluye artículos con estado "DADO DE BAJA" y ubicaciones "Dados de Bajas"
        $builder->where('e.nombre !=', 'DADO DE BAJA');
        $builder->where('u.nombre !=', 'DADOS DE BAJAS');
    
        // Ordena por nombre de artículo y fecha de ingreso
        $builder->orderBy('a.nombre', 'ASC');
        $builder->orderBy('ia.fecha_ingreso', 'DESC');
    
        $query = $builder->get();
    
        return $query->getResult();
    }
    

    public function exists($articulo_id, $ubicacion_id, $estado_id, $procedencia_id)
    {
        return $this->where([
                'articulo_id' => $articulo_id,
                'ubicacion_id' => $ubicacion_id,
                'estado_id' => $estado_id,
                'procedencia_id' => $procedencia_id
            ])->first() !== null;
    }
}
