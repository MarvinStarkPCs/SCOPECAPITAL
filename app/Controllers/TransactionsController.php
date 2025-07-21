<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UserManagementModel;
use App\Models\HistoryTransactionModel;
use CodeIgniter\Controller;

class TransactionsController extends BaseController
{
    public function index()
    {
        return view('system/transactions'); // Load the 'transactions' view if user is logged in
    }

    public function search()
    {
        // Log to verify that the data is received correctly
        log_message('info', 'Starting user search...');
        $usuario = $this->request->getPost('identification');
        log_message('info', 'Received identification: ' . $usuario);
        $model = new UserManagementModel();
        $user = $model->getUserByIdentification($usuario);
        if ($user) {
            // Success log when user is found
            log_message('info', 'User found: ' . json_encode($user));
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $user
            ]);
        } else {
            // Error log when user is not found
            log_message('error', 'User not found with identification: ' . $usuario);
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }
    }

    public function pay()
    {
        log_message('info', 'Starting recharge() method');

        $identification = $this->request->getPost('identification');
        $amount = floatval($this->request->getPost('amount'));
        $id_user = $this->request->getPost('id_user');
        log_message('info', "Received user ID: {$id_user}");

        log_message('info', "Received identification: {$identification}");
        log_message('info', "Received amount: {$amount}");

        // Data validation
        if ($amount <= 0) {
            log_message('error', 'Invalid amount (less than or equal to 0)');
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'The amount must be greater than 0'
            ]);
        }

        // Load the model
        $userModel = new UserManagementModel();
        log_message('info', 'User model loaded');

        // Search user
        $user = $userModel->getUserByIdentification($identification);
        log_message('info', 'Query executed to search user');

        if ($user) {
            log_message('info', 'User found: ' . json_encode($user));

            // Check if user has enough balance
            if ($user['balance'] < $amount) {
                log_message('error', 'Insufficient balance to make the payment');
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Insufficient balance to make the payment'
                ]);
            }

            $newBalance = $user['balance'] - $amount;
            log_message('info', "New calculated balance: {$newBalance}");

            // Update user's balance
            if ($userModel->updateUserBalance($identification, $newBalance)) {
                log_message('info', 'Balance updated successfully');
                $history = new HistoryTransactionModel();
                $history->create([
                    'user_id' => $id_user,
                    'amount' => $amount,
                    'transaction_type' => 'pay',
                    'transaction_date' => date('Y-m-d H:i:s')
                ]);
                return $this->response->setJSON([
                    'status' => 'success',
                    'newBalance' => $newBalance
                ]);
            } else {
                log_message('error', 'Error updating balance');
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Error updating balance'
                ]);
            }
        } else {
            log_message('error', 'User not found with identification: ' . $identification);
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }
    }
}
