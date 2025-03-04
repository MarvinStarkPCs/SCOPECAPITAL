<?php 
namespace App\Models;
use CodeIgniter\Model;

class CompanyModel extends Model {
    protected $table = "company";
    protected $primaryKey = "id_company";
    protected $allowedFields = ['name', 'address', 'telephone', 'email', 'representative'];
    protected $returnType = 'array';
}
