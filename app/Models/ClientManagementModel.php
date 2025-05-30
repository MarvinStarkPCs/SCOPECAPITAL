<?php
namespace App\Models;
use CodeIgniter\Model;

class ClientManagementModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['name', 'last_name', 'identification', 'password_hash', 'role_id', 'email', 'phone', 'address', 'status', 'login_attempts', 'last_login_attempt', 'balance', 'date_registration','compoundingPeriods','rate','time', 'principal', 'agreement', 'number', 'letter', 'date_from', 'date_to', 'policy', 'approved_by', 'approved_date', 'trust', 'email_del_trust', 'telephone_del_trust', 'bank', 'swift', 'aba', 'iban', 'account'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    // Método para obtener usuarios sin la contraseña
    public function getUsers($id = null)
    {
      $query = $this->select([
    // 🧾 CATEGORÍA: ACUERDOS
    'users.agreement',
    'users.number',
    'users.letter',
    'users.date_from',
    'users.date_to',
    'users.policy',
    'users.approved_by',
    'users.approved_date',

    // 👤 CATEGORÍA: CLIENTE
    'users.id_user',
    'users.name',
    'users.last_name',
    'users.identification',
    'users.email',
    'users.phone',
    'users.address',
    'users.trust',
    'users.email_del_trust',
    'users.telephone_del_trust',

    // 🏦 CATEGORÍA: BANCARIO
    'users.bank',
    'users.swift',
    'users.aba',
    'users.iban',
    'users.account',

    // 🔐 CATEGORÍA: SEGURIDAD Y ACCESO
    'users.password_hash',
    'users.date_registration',
    'users.login_attempts',
    'users.last_login_attempt',
    'users.status',
    'users.role_id',

    // 💰 CATEGORÍA: FINANZAS / PRÉSTAMOS
    'users.balance',
    'users.principal',
    'users.rate',
    'users.compoundingPeriods',
    'users.time',

    // Rol
    'roles.role_name'
])
->join('roles', 'roles.id_role = users.role_id')
->where('roles.role_name', 'CLIENT');



        if ($id !== null) {
            $query->where('users.id_user', $id);
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

