<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class IndexController extends BaseController
{
    public function index()
    {
        $session = session();

        // Verifica si el usuario está logueado
        if ($session->get('login')) {
            // Redirige al usuario a la página principal
            return redirect()->to('/admin/dashboard');
        } else {
            // Muestra la vista de login si no está logueado
            return view('index');
        }
}
}

