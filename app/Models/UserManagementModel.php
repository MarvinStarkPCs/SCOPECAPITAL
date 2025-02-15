<?php
namespace App\Models;
use CodeIgniter\Model;

class UserManagementModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['name', 'last_name', 'identification', 'password_hash', 'role_id', 'email', 'phone', 'address','status', 'login_attempts', 'last_login_attempt'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    // Método para obtener usuarios sin la contraseña
    public function getUsers()
    {
        return $this->select('users.id_user, users.name, users.last_name, users.identification, users.email, 
                             users.phone, users.address, users.status, users.login_attempts, 
                             users.last_login_attempt, users.role_id, users.date_registration, 
                             roles.role_name')
                    ->join('roles', 'roles.id_role = users.role_id')
                    ->findAll();
    }
}

