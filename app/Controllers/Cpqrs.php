<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Cpqrs extends Controller
{
    public function index()
    {
            return view('pqrs'); // Carga la vista 'home' si el usuario está logueado
     
}}