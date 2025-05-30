<?php

namespace App\Controllers;

use App\Models\UserModel;
$HOLA;
class AuthController extends BaseController
{
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
            ? redirect()->to('/admin/dashboard') 
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

        $userModel = new UserModel();
        $user = $userModel->login($email, $password);

        if ($user) {
            $session = session();
            $session->set([
                'login' => true,
                'id_user' => $user['id_user'],
                'name' => $user['name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'role_id' => $user['role_id'],
            ]);


        // Redirige según el rol del usuario
        return ($session->get('role_id') == 1) 
        ? redirect()->to('/admin/dashboard') 
        : redirect()->to('/client/dashboard');
            
        } else {
            return redirect()->back()->with('error', 'Correo electrónico o contraseña incorrectos.');
        }
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

}
