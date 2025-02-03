<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Cgestionextra extends Controller
{
    public function index()
    {
        $session = session();

        // Agrega mensajes de log para depurar
        log_message('debug', 'Session Data: ' . print_r($session->get(), true));

        if (!$session->get('login')) {
            log_message('debug', 'Redirecting to login because session is not set.');
            return redirect()->to('/'); // Redirige a la página de login si no hay sesión
        } else {
            log_message('debug', 'User is logged in, loading home view.');
            return view('gestion_de_extras/gestionextras'); // Carga la vista 'gestionextras' si el usuario está logueado
        }
    }
}
