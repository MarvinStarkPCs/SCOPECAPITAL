<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryTransactionModel extends Model
{
    protected $table      = 'history_transactions'; // Nombre de la tabla
    protected $primaryKey = 'id_transaction'; // Clave primaria

    protected $allowedFields = ['user_id','amount','transaction_type','transaction_date','id_transaction']; // Campos permitidos para inserción/actualización

    protected $returnType = 'array';

    // === MÉTODOS PERSONALIZADOS ===
    
    /**
     * Obtiene todos los registros con posibilidad de aplicar filtros.
     */
    public function getTransactionsHistoryByUser($user_id)
    {
        
        return $this->db->table('history_transactions ht')
        ->select('u.name, u.last_name, u.email, u.phone, ht.amount, ht.transaction_type, ht.transaction_date')
            ->join('users u', 'ht.user_id = u.id_user')
            ->where('ht.user_id', $user_id) // Filtra por usuario
            ->get()
            ->getResultArray(); 
    }


    public function getAll($conditions = [])
    {
        return $this->where($conditions)->findAll();
    }

    /**
     * Obtiene un registro por su ID.
     */
    public function getById($id)
    {
        return $this->find($id);
    }

    /**
     * Inserta un nuevo registro.
     */
    public function create(array $data)
    {
        return $this->insert($data);
    }

    /**
     * Actualiza un registro por ID.
     */
    public function updateById($id, array $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Elimina un registro por ID.
     */
    public function deleteById($id)
    {
        return $this->delete($id);
    }
}
