<?php

namespace App\Controllers;
use App\Models\ComboBoxModel;

class HomeController extends BaseController
{
    public function index()
    {
        $session = session();
        $role_id = $session->get('role_id');
    
        if ($role_id == 1) {
            // Vista para administradores
            return view('extras_management/extras_management');
        } else {
            return redirect()->to('/client/pqrs-sent');
        }
    }
}
