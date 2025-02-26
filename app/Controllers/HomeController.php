<?php
namespace App\Controllers;
class HomeController extends BaseController
{
    public function index()
    {
        $session = session();
        $role_id = $session->get('role_id');
    
        if ($role_id == 1) {
            return view('home'); // Vista para administradores
        } else {
            return view(name: 'system/pqrsmanagementclient'); // Vista para otros usuarios
        }
    }
    
    
}
