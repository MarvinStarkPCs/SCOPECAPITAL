<?php
namespace App\Models;
use CodeIgniter\Model;
class RequestTypesModel extends Model
{
    protected $table = 'request_types';
    protected $primaryKey = 'id_type';
    protected $allowedFields = ['name', 'description','created_at'];
    protected $useTimestamps = true;
    protected $returnType = 'array';
}
