<?php
namespace App\Controllers;

use App\Models\UserManagementModel;

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
}
