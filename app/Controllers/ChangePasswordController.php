<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\Log\Logger;

class ChangePasswordController extends BaseController
{
    // Cargar la vista inicial del formulario de cambio de contraseña
    public function index()
    {
        log_message('info', 'Acceso a la vista de cambio de contraseña.');
        return view('security/ChangePassword/changepassword');
    }

    // Método para manejar el formulario de cambio de contraseña
    public function updatePassword()
    {
        // Cargar el modelo de usuario
        $userModel = new UserModel();

        // Obtener los datos enviados por el formulario
        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');
        
        log_message('info', 'Solicitud de cambio de contraseña recibida.');
        
        // Verificar que la nueva contraseña y la confirmación sean iguales
        if ($newPassword !== $confirmPassword) {
            log_message('error', 'Las contraseñas no coinciden.');
            return redirect()->back()->with('error', 'Las contraseñas no coinciden');
        }

        // Obtener el usuario actual desde la sesión
        $user = $userModel->find(session()->get('id_user'));

        // Verificar si la contraseña actual es correcta
        if (!password_verify($currentPassword, $user['password_hash'])) {
            log_message('error', 'La contraseña actual es incorrecta para el usuario con ID: ' . session()->get('user_id'));
            return redirect()->back()->with('error', 'La contraseña actual es incorrecta');
        }

        // Validar los requisitos de la nueva contraseña
        if (strlen($newPassword) < 8 || !preg_match('/[A-Z]/', $newPassword) || !preg_match('/\d/', $newPassword)) {
            log_message('error', 'La nueva contraseña no cumple con los requisitos de seguridad.');
            return redirect()->back()->with('error', 'La nueva contraseña debe tener al menos 8 caracteres, una mayúscula y un número');
        }

        // Encriptar la nueva contraseña
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        log_message('info', 'Nueva contraseña encriptada para el usuario con ID: ' . session()->get('user_id'));

        // Actualizar la contraseña en la base de datos
        if ($userModel->update($user['id_user'], ['password_hash' => $newPasswordHash])) {
            log_message('info', 'Contraseña actualizada con éxito para el usuario con ID: ' . session()->get('user_id'));
            // Redirigir con un mensaje de éxito
            return redirect()->to('/admin/changepassword')->with('success', 'Contraseña actualizada con éxito');
        } else {
            log_message('error', 'Error al actualizar la contraseña para el usuario con ID: ' . session()->get('user_id'));
            return redirect()->back()->with('error', 'Error al actualizar la contraseña');
        }
    }
}
