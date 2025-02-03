<?php

namespace App\Controllers;

use App\Models\GestionUsuariosModel;
use App\Models\ComboboxModel;
use CodeIgniter\Controller;

class Cgestionusuarios extends Controller
{
    public function index()
    {
        $session = session();
        // Verifica si la sesión 'login' está activa
        if (!$session->get('login')) {
            return redirect()->to('/login'); // Redirige al login si no está logueado
        } else {
            $modelUsuarios = new GestionUsuariosModel();
            $modelPerfiles = new ComboboxModel();
            $data['usuarios'] = $modelUsuarios->getUsuariosConRoles();
            log_message('info', 'Se han obtenido los usuarios con sus roles: ' . json_encode($data['usuarios']));
            $data['perfiles'] = $modelPerfiles->getTableData('roles');
            return view('gestionUsuarios', $data); // Carga la vista 'gestionUsuarios' con los datos de usuarios
        }
    }

    public function addusuario()
    {
        $validation = \Config\Services::validation();
        $modelUsuarios = new GestionUsuariosModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'last_name' => $this->request->getPost('last_name'),
            'identification' => $this->request->getPost('identification'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role_id' => $this->request->getPost('role_id'),
            'status' => $this->request->getPost('status')
        ];

        if ($validation->run($data, 'user')) {
            $modelUsuarios->crearUsuario($data);
            return redirect()->to('/gestionusuarios')->with('success', 'Usuario creado exitosamente');
        } else {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    }

    public function editusuario($id)
    {
        $modelUsuarios = new GestionUsuariosModel();
        $data['usuario'] = $modelUsuarios->obtenerUsuarioPorId($id);
        return view('editUsuario', $data);
    }

    public function updateusuario($id)
    {
        $validation = \Config\Services::validation();
        $modelUsuarios = new GestionUsuariosModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'last_name' => $this->request->getPost('last_name'),
            'identification' => $this->request->getPost('identification'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'role_id' => $this->request->getPost('role_id'),
            'status' => $this->request->getPost('status')
        ];

        if ($validation->run($data, 'user')) {
            $modelUsuarios->actualizarUsuario($id, $data);
            return redirect()->to('/gestionusuarios')->with('success', 'Usuario actualizado exitosamente');
        } else {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    }

    public function deleteusuario($id)
    {
        $modelUsuarios = new GestionUsuariosModel();
        $modelUsuarios->eliminarUsuario($id);
        return redirect()->to('/gestionusuarios')->with('success', 'Usuario eliminado exitosamente');
    }
}
