<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $allowedFields = ['name', 'last_name', 'identification', 'password_hash', 'role_id', 'email', 'phone', 'status','login_attempts', 'last_login_attempt','reset_token', 'reset_token_expiration'  ];
    protected $useTimestamps = false;

    // Verifica si el usuario existe y la contraseña es correcta
   public function login($email, $password)
{
    $user = $this->where('email', $email)->first();

    if (!$user) {
        return false; // Usuario no encontrado
    }

    // Verifica si el usuario está activo
    if ($user['status'] !== 'active') {
        return 'inactive'; // Usuario desactivado
    }

    // Verifica si el usuario está bloqueado por muchos intentos
    if ($user['login_attempts'] >= 5) {
        $lastAttempt = strtotime($user['last_login_attempt']);
        $minutesSinceLast = (time() - $lastAttempt) / 60;

        if ($minutesSinceLast < 10) {
            return 'locked'; // Usuario bloqueado temporalmente
        }
    }

    // Verifica la contraseña
    if (password_verify($password, $user['password_hash'])) {
        // Reinicia intentos
        $this->update($user['id_user'], [
            'login_attempts' => 0,
            'last_login_attempt' => date('Y-m-d H:i:s'),
        ]);
        return $user;
    } else {
        // Aumenta intentos fallidos
        $this->update($user['id_user'], [
            'login_attempts' => $user['login_attempts'] + 1,
            'last_login_attempt' => date('Y-m-d H:i:s'),
        ]);
        return false;
    }
}

}