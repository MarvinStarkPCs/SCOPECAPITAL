<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Ctransactions extends Controller
{
    public function index()
    {

        return view('transactions'); // Carga la vista 'home' si el usuario está logueado
    }
}
