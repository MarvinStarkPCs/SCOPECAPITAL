<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\Log\Logger;

class ChangePasswordController extends BaseController
{
    // Load the initial view for the change password form
    public function index()
    {
        return view('security/ChangePassword/changepassword');
    }

    // Method to handle the password change form
    public function updatePassword()
    {
        // Load the user model
        $userModel = new UserModel();

        // Get the data submitted from the form
        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');
        
        log_message('info', 'Password change request received.');
        
        // Verify that the new password and confirmation match
        if ($newPassword !== $confirmPassword) {
            log_message('error', 'Passwords do not match.');
            return redirect()->back()->with('error', 'Passwords do not match.');
        }

        // Get the current user from the session
        $user = $userModel->find(session()->get('id_user'));

        // Verify that the current password is correct
        if (!password_verify($currentPassword, $user['password_hash'])) {
            log_message('error', 'The current password is incorrect for user ID: ' . session()->get('user_id'));
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        // Validate the new password requirements
        if (strlen($newPassword) < 8 || !preg_match('/[A-Z]/', $newPassword) || !preg_match('/\d/', $newPassword)) {
            log_message('error', 'The new password does not meet the security requirements.');
            return redirect()->back()->with('error', 'The new password must be at least 8 characters long, contain an uppercase letter, and a number.');
        }

        // Encrypt the new password
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        log_message('info', 'New password hashed for user ID: ' . session()->get('user_id'));

        // Update the password in the database
        if ($userModel->update($user['id_user'], ['password_hash' => $newPasswordHash])) {
            log_message('info', 'Password successfully updated for user ID: ' . session()->get('user_id'));
            // Redirect with success message
            return redirect()->to('/admin/changepassword')->with('success', 'Password successfully updated.');
        } else {
            log_message('error', 'Error updating password for user ID: ' . session()->get('user_id'));
            return redirect()->back()->with('error', 'Error updating the password.');
        }
    }
}

