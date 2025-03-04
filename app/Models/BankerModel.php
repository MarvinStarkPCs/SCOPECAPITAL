<?php 
namespace App\Models;
use CodeIgniter\Model;

class BankerModel extends Model{
    protected $table = "banker";
    protected $primaryKey = "id_banker";
    protected $allowedFields = ['name','telephone','email','id_banker'];
    protected $returnType = 'array';
}