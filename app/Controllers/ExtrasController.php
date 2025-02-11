<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class ExtrasController extends BaseController
{
    public function index()
    {
     
            return view('gestion_de_extras/gestionextras'); // Carga la vista 'gestionextras' si el usuario está logueado
       
    }
}
