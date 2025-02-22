<?php
namespace App\Controllers;
use App\Models\HistoryTransactionModel;
use App\Models\UserManagementModel;

class HistoryTransactionsController extends BaseController
{
    public function index()
    {
        return view('history/historytransaction'); // Carga la vista 'home' si el usuario está logueado
    }

    public function renderViewHistoryTransaction($id_user)
    {
        if (!is_numeric($id_user) || $id_user <= 0) {
            return redirect()->to('/error')->with('error', 'ID de usuario inválido.');
        }
    
        $userTransaction = new HistoryTransactionModel();
        $transactions = $userTransaction->getTransactionsHistoryByUser($id_user);
    
        $usersModel = new UserManagementModel();
        $users = $usersModel->getUserByIdUser($id_user);
    
        if (empty($transactions)) {
            log_message('debug', 'No se encontraron transacciones para el usuario ID: ' . $id_user);
        } else {
            log_message('info', 'Historial de transacciones: ' . json_encode($transactions, JSON_PRETTY_PRINT));
        }
    
        return view('history/view/detail', [
            'transactions' => $transactions,
            'users' => $users
        ]);
    }
    
      

}