<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Chome extends Controller
{
    public function index()
    {
        $session = session();

        // Agrega mensajes de log para depurar
        log_message('debug', 'Session Data: ' . print_r($session->get(), true));

        if (!$session->get('login')) {
            log_message('debug', 'Redirecting to login because session is not set.');
            return redirect()->to('/login'); // Redirige a la página de login si no hay sesión
        } else {
            log_message('debug', 'User is logged in, loading home view.');
            return view('home'); // Carga la vista 'home' si el usuario está logueado
        }
    }
}
