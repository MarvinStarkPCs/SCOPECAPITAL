<?php
namespace App\Models;
use CodeIgniter\Model;

class ComboboxModel extends Model
{
    protected $DBGroup = 'default';

    public function getTableData($tablaName, $exclusions = [])
    {
        // Verifica si la tabla existe
        if (!$this->db->tableExists($tablaName)) {
            return false;
        }

        // Crea la consulta
        $builder = $this->db->table($tablaName);

        // Aplica las exclusiones si las hay (utiliza whereNotIn)
        foreach ($exclusions as $field => $values) {
            $builder->whereNotIn($field, $values);
        }

        // Ejecuta la consulta y devuelve el resultado
        return $builder->get()->getResultArray();
    }
}

