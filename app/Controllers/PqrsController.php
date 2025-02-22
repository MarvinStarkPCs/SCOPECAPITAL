<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class PqrsController extends Controller
{
    public function index()
    {
            return view('system/pqrs'); // Carga la vista 'home' si el usuario está logueado
     
}}