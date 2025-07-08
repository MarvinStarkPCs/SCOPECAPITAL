<?php

namespace App\Controllers;

use App\Libraries\SendEmail;
use CodeIgniter\HTTP\RedirectResponse;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $session = session();
        $roleId = $session->get('role_id');
        log_message('info', "Usuario autenticado con role_id: {$roleId}");
        // Verifica si el usuario está autenticado
        if (!$session->has('login')) {
            return view('/auth/login'); // Si no está logueado, muestra la vista de login
        }
        // Redirige según el rol del usuario
        return ($session->get('role_id') == 1)
            ? redirect()->to('/admin/pqrsmanagement')
            : redirect()->to('/client/dashboard');
    }
    public function authenticate()
    {
        log_message('info', 'El método authenticate fue llamado');
        // Reglas de validación con mensajes personalizados
        $rules = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'El campo de correo electrónico es obligatorio.',
                    'valid_email' => 'Debe ingresar un correo electrónico válido.',
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'El campo de contraseña es obligatorio.',
                    'min_length' => 'La contraseña debe tener al menos 8 caracteres.',
                ],
            ],
        ];
        // Validación
        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', implode('<br>', $this->validator->getErrors()));
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->login($email, $password);

        // Manejo de respuestas especiales
        if ($user === 'locked') {
            return redirect()->back()->with('error', 'Demasiados intentos fallidos. Intenta nuevamente en 10 minutos.');
        }

        if ($user === 'inactive') {
            return redirect()->back()->with('error', 'Tu cuenta está desactivada. Contacta al administrador.');
        }

        if ($user) {
            $session = session();
            $session->set([
                'login' => true,
                'id_user' => $user['id_user'],
                'name' => $user['name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'role_id' => $user['role_id'],
                'profile_image' => $user['profile_image'] ?? null,
            ]);

            log_message('info', 'Usuario autenticado con ID: ' . $user['id_user'] . ', Nombre: ' . $user['name'] . ' ' . $user['last_name']);

            return ($user['role_id'] == 1)
                ? redirect()->to('/admin/pqrsmanagement')
                : redirect()->to('/client/dashboard');
        } else {
            return redirect()->back()->with('error', 'Correo electrónico o contraseña incorrectos.');
        }
    }

    public function recover()
    {


         $session = session();
        $roleId = $session->get('role_id');
        log_message('info', "Usuario autenticado con role_id: {$roleId}");
        // Verifica si el usuario está autenticado
        if (!$session->has('login')) {
        return view('auth/forgot_password');
        }
        // Redirige según el rol del usuario
        return ($session->get('role_id') == 1)
            ? redirect()->to('/admin/pqrsmanagement')
            : redirect()->to('/client/dashboard');
    }
    public function logout()
    {
        $session = session();
        $session->remove('login');  // Elimina la variable de sesión

        $session->destroy(); // Destruye la sesión actual

        // Agregar un retraso en la sesión para evitar redirección inmediata con caché
        session_write_close();

        return redirect()->to(base_url('/login'))->with('message', 'Sesión cerrada correctamente.');
    }
    public function sendRecoveryLink(): RedirectResponse
    {
        $emailUsuario = $this->request->getPost('email');
        // Verificar si el correo existe en la base de datos
        $user = $this->userModel->where('email', $emailUsuario)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'No se encontró el correo en nuestra base de datos.');
        }

        // Generar token de recuperación
        helper('text');
        $token = random_string('alnum', 32);

        // Guardar token y fecha de expiración (1 hora) en la base de datos
        $this->userModel->update($user['id_user'], [
            'reset_token' => $token,
            'reset_token_expiration' => date('Y-m-d H:i:s', strtotime('+1 hour'))
        ]);

        // Preparar los datos para el correo
        $data = [
            'name' => $user['name'],
            'last_name' => $user['last_name'],
            'link' => base_url("reset-password/{$token}")
        ];

        // Construir mensaje HTML
        $message = '
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Recuperar contraseña - Scope Capital</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
</head>
<body style="font-family: Nunito, Arial, sans-serif; background-color: #f5f7fa; padding: 0; margin: 0; color: #333;">
  <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
    
    <!-- Encabezado -->
    <div style="background-color: #192229; color: #F1C40F; padding: 25px; text-align: center;">
      <img src="https://i.imgur.com/ZQcJdWg.png" alt="Logo Scope Capital" style="max-height: 60px; margin-bottom: 10px;">
      <h2 style="margin: 0;">🔐 Recupera tu contraseña</h2>
    </div>
    
    <!-- Contenido principal -->
    <div style="padding: 30px;">
      <p>Hola <strong>' . esc($data["name"]) . ' ' . esc($data["last_name"]) . '</strong>,</p>
      <p>Hemos recibido una solicitud para restablecer tu contraseña en Scope Capital.</p>
      <p>Para continuar, haz clic en el siguiente botón:</p>
      <p style="text-align: center; margin: 30px 0;">
        <a href="' . $data['link'] . '" style="background-color: #F1C40F; color: #192229; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-weight: bold;">Restablecer contraseña</a>
      </p>
      <p>Este enlace es válido por <strong>1 hora</strong>. Si no solicitaste este cambio, puedes ignorar este mensaje.</p>
      <p style="margin-top: 40px;">Gracias por confiar en nosotros,</p>
      <p>El equipo de Scope Capital</p>
    </div>

    <!-- Footer -->
    <div style="background-color: #192229; text-align: center; padding: 15px; font-size: 12px; color: #F1C40F;">
      © ' . date("Y") . ' Scope Capital. Todos los derechos reservados.
    </div>

  </div>
</body>
</html>';


        // Enviar el correo
        $sendEmail = new SendEmail();
        $enviado = $sendEmail->send($emailUsuario, 'Restablece tu contraseña - Scope Capital', $message);

        if ($enviado) {
            return redirect()->to('recover')->with('success', 'Te hemos enviado un enlace para restablecer tu contraseña.');
        } else {
            return redirect()->to('recover')->with('error', 'Ocurrió un error al enviar el correo. Intenta nuevamente.');
        }
    }


public function resetPassword($token)
{
    $user = $this->userModel->where('reset_token', $token)
        ->where('reset_token_expiration >=', date('Y-m-d H:i:s'))
        ->first();

    if (!$user) {
        return redirect()->to('recover')->with('error', 'El enlace de recuperación es inválido o ha expirado.');
    }


     $session = session();
        $roleId = $session->get('role_id');
        log_message('info', "Usuario autenticado con role_id: {$roleId}");
        // Verifica si el usuario está autenticado
        if (!$session->has('login')) {

    return view('auth/reset_password', ['token' => $token]);
        }
        // Redirige según el rol del usuario
        return ($session->get('role_id') == 1)
            ? redirect()->to('/admin/pqrsmanagement')
            : redirect()->to('/client/dashboard');

}
public function resetPasswordConfirm()
{
    $token = $this->request->getPost('token');
    $password = $this->request->getPost('password');
    $confirm = $this->request->getPost('confirm_password');

    // Validaciones de seguridad
    if (strlen($password) < 8) {
        return redirect()->back()->with('error', 'La contraseña debe tener al menos 8 caracteres.');
    }

    if (!preg_match('/[A-Z]/', $password)) {
        return redirect()->back()->with('error', 'La contraseña debe contener al menos una letra mayúscula.');
    }

    if (!preg_match('/[a-z]/', $password)) {
        return redirect()->back()->with('error', 'La contraseña debe contener al menos una letra minúscula.');
    }

    if (!preg_match('/\d/', $password)) {
        return redirect()->back()->with('error', 'La contraseña debe contener al menos un número.');
    }

    if (!preg_match('/[\W_]/', $password)) {
        return redirect()->back()->with('error', 'La contraseña debe contener al menos un carácter especial.');
    }

    if (preg_match('/\s/', $password)) {
        return redirect()->back()->with('error', 'La contraseña no debe contener espacios.');
    }

    if ($password !== $confirm) {
        return redirect()->back()->with('error', 'Las contraseñas no coinciden.');
    }

    // Verifica el token y su vigencia
    $user = $this->userModel->where('reset_token', $token)
        ->where('reset_token_expiration >=', date('Y-m-d H:i:s'))
        ->first();

    if (!$user) {
        return redirect()->to('recover')->with('error', 'El enlace ha expirado o no es válido.');
    }

    // Guarda la nueva contraseña
    $this->userModel->update($user['id_user'], [
        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        'reset_token' => null,
        'reset_token_expiration' => null
    ]);

    return redirect()->to('login')->with('success', 'Tu contraseña ha sido actualizada correctamente.');
}


}
