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
            'required' => 'The email field is required.',
            'valid_email' => 'You must enter a valid email address.',
        ],
    ],
    'password' => [
        'rules' => 'required|min_length[8]',
        'errors' => [
            'required' => 'The password field is required.',
            'min_length' => 'The password must be at least 8 characters long.',
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
    return redirect()->back()->with('error', 'Too many failed attempts. Please try again in 10 minutes.');
}

if ($user === 'inactive') {
    return redirect()->back()->with('error', 'Your account is deactivated. Please contact the administrator.');
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
return redirect()->back()->with('error', 'Incorrect email or password.');
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

return redirect()->to(base_url('/login'))->with('message', 'You have successfully logged out.');
    }
    public function sendRecoveryLink(): RedirectResponse
    {
        $emailUsuario = $this->request->getPost('email');
        // Verificar si el correo existe en la base de datos
        $user = $this->userModel->where('email', $emailUsuario)->first();

        if (!$user) {
return redirect()->back()->with('error', 'Email not found in our database.');

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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Password Recovery - Scope Capital</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
</head>
<body style="font-family: Nunito, Arial, sans-serif; background-color: #f5f7fa; padding: 0; margin: 0; color: #333;">
  <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
    
    <!-- Header -->
    <div style="background-color: #192229; color: #F1C40F; padding: 25px; text-align: center;">
      <img src="https://i.imgur.com/ZQcJdWg.png" alt="Scope Capital Logo" style="max-height: 60px; margin-bottom: 10px;">
      <h2 style="margin: 0;">🔐 Reset Your Password</h2>
    </div>
    
    <!-- Main Content -->
    <div style="padding: 30px;">
      <p>Hello <strong>' . esc($data["name"]) . ' ' . esc($data["last_name"]) . '</strong>,</p>
      <p>We received a request to reset your password for your Scope Capital account.</p>
      <p>To proceed, please click the button below:</p>
      <p style="text-align: center; margin: 30px 0;">
        <a href="' . $data['link'] . '" style="background-color: #F1C40F; color: #192229; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-weight: bold;">Reset Password</a>
      </p>
      <p>This link is valid for <strong>1 hour</strong>. If you did not request this change, you can safely ignore this message.</p>
      <p style="margin-top: 40px;">Thank you for trusting us,</p>
      <p>The Scope Capital Team</p>
    </div>

    <!-- Footer -->
    <div style="background-color: #192229; text-align: center; padding: 15px; font-size: 12px; color: #F1C40F;">
      © ' . date("Y") . ' Scope Capital. All rights reserved.
    </div>

  </div>
</body>
</html>';



        // Enviar el correo
        $sendEmail = new SendEmail();
        $enviado = $sendEmail->send($emailUsuario, 'Reset Your Password - Scope Capital', $message);
if ($enviado) {
    return redirect()->to('recover')->with('success', 'We have sent you a link to reset your password.');
} else {
    return redirect()->to('recover')->with('error', 'An error occurred while sending the email. Please try again.');
}

    }


public function resetPassword($token)
{
    $user = $this->userModel->where('reset_token', $token)
        ->where('reset_token_expiration >=', date('Y-m-d H:i:s'))
        ->first();

    if (!$user) {
return redirect()->to('recover')->with('error', 'The recovery link is invalid or has expired.');

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

   // Security validations
if (strlen($password) < 8) {
    return redirect()->back()->with('error', 'The password must be at least 8 characters long.');
}

if (!preg_match('/[A-Z]/', $password)) {
    return redirect()->back()->with('error', 'The password must contain at least one uppercase letter.');
}

if (!preg_match('/[a-z]/', $password)) {
    return redirect()->back()->with('error', 'The password must contain at least one lowercase letter.');
}

if (!preg_match('/\d/', $password)) {
    return redirect()->back()->with('error', 'The password must contain at least one number.');
}

if (!preg_match('/[\W_]/', $password)) {
    return redirect()->back()->with('error', 'The password must contain at least one special character.');
}

if (preg_match('/\s/', $password)) {
    return redirect()->back()->with('error', 'The password must not contain spaces.');
}

if ($password !== $confirm) {
    return redirect()->back()->with('error', 'Passwords do not match.');
}


    // Verifica el token y su vigencia
    $user = $this->userModel->where('reset_token', $token)
        ->where('reset_token_expiration >=', date('Y-m-d H:i:s'))
        ->first();

    if (!$user) {
return redirect()->to('recover')->with('error', 'The link has expired or is invalid.');
    }

    // Guarda la nueva contraseña
    $this->userModel->update($user['id_user'], [
        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        'reset_token' => null,
        'reset_token_expiration' => null
    ]);

return redirect()->to('login')->with('success', 'Your password has been successfully updated.');
}


}
