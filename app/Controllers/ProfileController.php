<?php
namespace App\Controllers;

use App\Models\UserManagementModel;
use App\Models\ClientManagementModel;
class ProfileController extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('id_user');
        $userModel = new UserManagementModel();
        $userData = $userModel->getUsers($userId);


        return view('aside/profile/profile', ['user' => $userData]);
    }

      public function index_client()
    {
        $session = session();
        $userId = $session->get('id_user');
        $userModel = new ClientManagementModel();
        $userData = $userModel->getUsers($userId);


        return view('aside/profile/profile', ['user' => $userData]);
    }
public function update()
{
    $session = session();
    $userId = $session->get('id_user');
    $userModel = new UserManagementModel();

    // Obtener solo campos permitidos del formulario
    $userData = $this->request->getPost(['name', 'last_name', 'email', 'phone','address', 'identification']);

    // Reglas de validación incluyendo imagen
    $rules = [
        'name'  => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email',
        'phone' => 'permit_empty|regex_match[/^[0-9]{10,15}$/]',
        'profile_image' => 'permit_empty|is_image[profile_image]|max_size[profile_image,2048]' // hasta 2MB
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Procesar imagen si se subió
    $file = $this->request->getFile('profile_image');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $uploadPath = 'upload/profile_images/';

        if ($file->move($uploadPath, $newName)) {
            $userData['profile_image'] =  $newName;
            log_message('info', 'Perfil: Imagen de perfil subida para el usuario ID: ' . $userId);
        } else {
            log_message('error', 'Perfil: Falló la subida de imagen para el usuario ID: ' . $userId);
        }
    }

 // Update user data
if ($userModel->update($userId, $userData)) {
    log_message('info', 'Profile: User ID ' . $userId . ' updated successfully.');
    return redirect()->to('admin/profile')->with('message', 'Profile updated successfully.');
} else {
    log_message('error', 'Profile: Failed to update user ID: ' . $userId);
    return redirect()->back()->withInput()->with('error', 'Failed to update profile.');
}

}

public function updateClient()
{
    $session = session();
    $userId = $session->get('id_user');
    $userModel = new UserManagementModel();

    // Obtener solo campos permitidos del formulario
    $userData = $this->request->getPost(['name', 'last_name', 'email', 'phone','address', 'identification']);

    // Reglas de validación incluyendo imagen
    $rules = [
        'name'  => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email',
        'phone' => 'permit_empty|regex_match[/^[0-9]{10,15}$/]',
        'profile_image' => 'permit_empty|is_image[profile_image]|max_size[profile_image,2048]' // hasta 2MB
    ];

    if (!$this->validate($rules)) {
        log_message('error', 'Perfil: Falló la validación para el usuario ID: ' . $userId);
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Procesar imagen si se subió
    $file = $this->request->getFile('profile_image');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $uploadPath = 'upload/profile_images/';

        if ($file->move($uploadPath, $newName)) {
            $userData['profile_image'] =  $newName;
            log_message('info', 'Perfil: Imagen de perfil subida para el usuario ID: ' . $userId);
        } else {
            log_message('error', 'Perfil: Falló la subida de imagen para el usuario ID: ' . $userId);
        }
    }
log_message('info', 'Datos enviados en el formulario de perfil: ' . print_r($userData, true));

    // Actualizar los datos
    if ($userModel->update($userId, $userData)) {
    log_message('info', 'Profile: User ID ' . $userId . ' updated successfully.');
    return redirect()->to('client/profile')->with('message', 'Profile updated successfully.');
} else {
    log_message('error', 'Profile: Failed to update user ID: ' . $userId);
    return redirect()->back()->withInput()->with('error', 'Failed to update profile.');
}

}

}
