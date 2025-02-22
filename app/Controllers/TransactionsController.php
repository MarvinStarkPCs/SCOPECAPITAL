<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UserManagementModel;
use App\Models\HistoryTransactionsModel;
use CodeIgniter\Controller;

class TransactionsController extends BaseController
{
    public function index()
    {
        return view('system/transactions'); // Carga la vista 'home' si el usuario está logueado
    }
    public function search()
    {
        // Log para verificar que se recibe el dato correctamente
        log_message('info', 'Iniciando búsqueda de usuario...');
        
        $usuario = $this->request->getPost('identification');
        log_message('info', 'Identificación recibida: ' . $usuario);
    
        $model = new UserManagementModel();
        $user = $model->getUserByIdentification( $usuario);
       
        if ($user) {
            // Log de éxito al encontrar al usuario
            log_message('info', 'Usuario encontrado: ' . json_encode($user));
            
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $user
            ]);
        } else {
            // Log de error si no se encuentra el usuario
            log_message('error', 'Usuario no encontrado con identificación: ' . $usuario);
            
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Usuario no encontrado'
            ]);
        }
    }
    
    public function recharge()
    {
        log_message('info', 'Iniciando el método recharge()');
    
        $identification = $this->request->getPost('identification');
        $amount = floatval($this->request->getPost('amount')); 
    
        log_message('info', "Identificación recibida: {$identification}");
        log_message('info', "Monto recibido: {$amount}");
    
        // Validación de datos
        if ($amount <= 0) {
            log_message('error', 'El monto es inválido (menor o igual a 0)');
    
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'El monto debe ser mayor a 0'
            ]);
        }
        $history = new HistoryTransactionsModel();
        $history->create($amount);
    
        // Cargar el modelo
        $userModel = new UserManagementModel();
        log_message('info', 'Modelo de usuarios cargado');
    
        // Buscar usuario
        $user = $userModel->getUserByIdentification($identification);
        log_message('info', 'Consulta realizada para buscar usuario');
    
        if ($user) {
            log_message('info', 'Usuario encontrado: ' . json_encode($user));
    
            $newBalance = $user['balance'] + $amount;
            log_message('info', "Nuevo balance calculado: {$newBalance}");
    
            // Actualizar saldo del usuario
            if ($userModel->updateUserBalance($identification, $newBalance)) {
                log_message('info', 'Saldo actualizado correctamente');
    
                return $this->response->setJSON([
                    'status' => 'success',
                    'newBalance' => $newBalance
                ]);
            } else {
                log_message('error', 'Error al actualizar el saldo');
    
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Error al actualizar el saldo'
                ]);
            }
        } else {
            log_message('error', 'Usuario no encontrado con la identificación: ' . $identification);
    
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Usuario no encontrado'
            ]);
        }
    }
    
    
    
   
}
