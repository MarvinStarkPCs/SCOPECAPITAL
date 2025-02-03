<?php namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nombre'];

    // Opcional: Si usas timestamps en tu tabla
    protected $useTimestamps = false;

    // Opcional: Configura el formato de fecha si usas timestamps
    // protected $dateFormat = 'datetime';
}
