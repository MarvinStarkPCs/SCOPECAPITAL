<?php
namespace App\Models;

use CodeIgniter\Model;

class GestionUsuariosModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'name', 'last_name', 'identification', 'phone', 'email', 
        'password_hash', 'role_id', 'status', 'login_attempts', 'last_login_attempt'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    // Obtener todos los usuarios con sus roles
    public function getUsuariosConRoles()
    {
        // Realizar la consulta
        $usuarios = $this->select('users.id_user, users.name, users.last_name, users.identification, users.phone, users.email, roles.role_name as role_name, roles.id_role as role_id')
                         ->join('roles', 'users.role_id = roles.id_role')
                         ->findAll();

        // Registrar los resultados de la consulta en el log

        return $usuarios;
    }

    // Crear un nuevo usuario
    public function crearUsuario($data)
    {
        return $this->insert($data);
    }

    // Actualizar un usuario existente
    public function actualizarUsuario($idUsuario, $data)
    {
        return $this->update($idUsuario, $data);
    }

    // Eliminar un usuario
    public function eliminarUsuario($idUsuario)
    {
        return $this->delete($idUsuario);
    }

    // Obtener un usuario por su ID
    public function obtenerUsuarioPorId($idUsuario)
    {
        return $this->find($idUsuario);
    }

    // Obtener un usuario por su correo electrónico
    public function obtenerUsuarioPorCorreo($email)
    {
        return $this->where('email', $email)->first();
    }

    // Verificar las credenciales de un usuario
    public function verificarCredenciales($email, $password)
    {
        $user = $this->where('email', $email)->first();

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }

        return false;
    }

    // Cambiar la contraseña de un usuario
    public function cambiarContrasena($idUsuario, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $data = [
            'password_hash' => $hashedPassword,
        ];

        return $this->update($idUsuario, $data);
    }
}