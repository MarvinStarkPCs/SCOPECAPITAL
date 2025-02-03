<?php

namespace App\Controllers;

use App\Models\UserModel;

class Clogin extends BaseController
{
    public function index()
    {
        $session = session();

        // Verifica si el usuario está logueado
        if ($session->get('login')) {
            // Redirige al usuario a la página principal
            return redirect()->to('/dashboard');
        } else {
            // Muestra la vista de login si no está logueado
            return view('login');
        }
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
                'email' => $user['email']
            ]);
            return redirect()->to('/dashboard'); // Redirige a la página principal
        } else {
            return redirect()->back()->with('error', 'Correo electrónico o contraseña incorrectos.');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy(); // Destruye la sesión actual
        return redirect()->to(base_url('/')); // Redirige a la página de login
    }
}
