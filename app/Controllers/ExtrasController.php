<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class ExtrasController extends BaseController
{
    public function index()
    {
     
            return view('extras_management/extras_management'); // Carga la vista 'gestionextras' si el usuario está logueado
       
    }
}
