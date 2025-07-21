<?php
namespace App\Controllers;

use App\Models\HistoryTransactionModel;
use App\Models\UserManagementModel;

class HistoryTransactionsController extends BaseController
{
    public function index()
    {
        return view('history/historytransaction'); // Load the main transaction history view
    }

    public function renderViewHistoryTransaction($id_user)
    {
        if (!is_numeric($id_user) || $id_user <= 0) {
            return redirect()->to('/error')->with('error', 'Invalid user ID.');
        }

        $transactionModel = new HistoryTransactionModel();
        $transactions = $transactionModel->getTransactionsHistoryByUser($id_user);

        $userModel = new UserManagementModel();
        $user = $userModel->getUserByIdUser($id_user);

        if (empty($transactions)) {
            log_message('debug', 'No transactions found for user ID: ' . $id_user);
        } else {
            log_message('info', 'Transaction history: ' . json_encode($transactions, JSON_PRETTY_PRINT));
        }

        return view('history/view/detail', [
            'transactions' => $transactions,
            'users' => $user
        ]);
    }

    public function filterByDate()
    {
        $model = new HistoryTransactionModel();

        // Get data via traditional POST
        $start    = $this->request->getPost('startDate');
        $end      = $this->request->getPost('endDate');
        $user_id  = $this->request->getPost('user_id');

        $results = $model->filtrarPorFecha($start, $end, $user_id);

        return $this->response->setJSON($results);
    }
}
