<?php
namespace App\Controllers;

class BankController extends BaseController
{
    public function index()
    {
        return view('extras_management/bank'); // Carga la vista 'bank' si el usuario está logueado
    }
}