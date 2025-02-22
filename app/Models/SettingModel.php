<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'configuration';  // Nombre de la tabla
    protected $primaryKey = 'id_config'; // Clave primaria de la tabla
    protected $allowedFields = ['config_key', 'config_value', 'description', 'created_at', 'updated_at']; // Campos permitidos
    protected $useTimestamps = true; // Habilita los timestamps automáticos (created_at, updated_at)
    protected $returnType = 'array';

 
    public function updateSMTPConfig($data)
    {
        // Verifica si ya existe el registro con config_key = 'smtp_config'
        $existingConfig = $this->where('config_key', $data['config_key'])->first();

        if ($existingConfig) {
            // Si existe, actualiza el registro
            return $this->update($existingConfig['id_config'], $data);
        } else {
            // Si no existe, inserta un nuevo registro
            return $this->insert($data);
        }
    }
}
