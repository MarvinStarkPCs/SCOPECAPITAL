<?php
namespace App\Models;
use CodeIgniter\Model;

class RequestStatusesModel extends Model
{
    protected $table = 'request_statuses';
    protected $primaryKey = 'id_request_status';
    protected $allowedFields = ['name', 'description','created_at'];
    protected $useTimestamps = true;
    protected $returnType = 'array';
}
