<?php
namespace App\Models;
use CodeIgniter\Model;

class UserManagementModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['name','profile_image', 'last_name', 'identification', 'password_hash', 'role_id', 'email', 'phone', 'address', 'status', 'login_attempts', 'last_login_attempt', 'balance', 'date_registration'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    // Método para obtener usuarios sin la contraseña
    public function getUsers($id = null)
    {
    log_message('info', 'UserManagementModel: getUsers called with id: ' . $id);
        $query = $this->select('users.id_user, users.name, users.last_name, users.identification, users.email, 
                                users.phone, users.address, users.status, users.login_attempts, 
                                users.last_login_attempt, users.role_id, users.date_registration,  users.profile_image,
                                roles.role_name')
            ->join('roles', 'roles.id_role = users.role_id')
            ->where('roles.role_name=', 'ADMIN'); // Excluye usuarios


        if ($id !== null) {
            $query->where('users.id_user', $id);
            log_message('info', 'UserManagementModel: Filtering by user ID: ' . $id);
            log_message('info', 'UserManagementModel: Query executed: ' . $query->getLastQuery());
            return $query->first(); // Retorna solo un usuario si hay filtro

        }
        

        return $query->findAll(); // Retorna todos los usuarios si no hay filtro
    }
    public function getUserByIdentification($identification)
    {
        return $this->where('identification', $identification)->first();
    }
    public function getUserByIdUser($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }
   

    /**
     * Actualiza el saldo del usuario
     */
    public function updateUserBalance($identification, $newBalance)
    {
        return $this->set('balance', $newBalance)
            ->where('identification', $identification)
            ->update();
    }
}

