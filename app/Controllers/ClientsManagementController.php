<?php
namespace App\Controllers;

use App\Models\ClientManagementModel;
use App\Models\ComboBoxModel;
use CodeIgniter\HTTP\ResponseInterface;

class ClientsManagementController extends BaseController
{
    public function index()
    {
        $userModel = new ClientManagementModel();
        $roleModel = new ComboBoxModel();
        $data = [

            'users' => $userModel->getUsers() ?? [],
            'roles' => $roleModel->getTableData('roles') ?? []
        ];
    log_message('info', 'Datos recogidos de LA BASE DE DATOS: ' . json_encode($data));

        return view('system/ClientManagement/ClientManagement', $data);
    }

    public function show($id)
    {
        $userModel = new ClientManagementModel();
        $user = $userModel->find($id);

        if ($user) {
            return $this->response->setJSON($user);
        } else {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                ->setJSON(['status' => 'error', 'message' => 'Usuario no encontrado']);
        }
    }

  public function addUser()
{
    log_message('info', 'Iniciando el método addUser()');

    $validation = \Config\Services::validation();
    $model = new ClientManagementModel();

    // Definir reglas de validación
    $rules = [
        'name' => 'required|min_length[2]|max_length[70]',
        'last_name' => 'required|min_length[2]|max_length[80]',
        'identification' => 'required|numeric|min_length[5]|max_length[20]|is_unique[users.identification]',
        'email' => 'required|valid_email|max_length[100]|is_unique[users.email]',
        'id_role' => 'required|numeric',
        'status' => 'required|in_list[active,inactive]',
    ];

    log_message('info', 'Reglas de validación definidas.');

    // Validar los datos
    if (!$this->validate($rules)) {
        log_message('error', 'Error en la validación de datos: ' . json_encode($validation->getErrors()));
        return redirect()->back()->withInput()->with('errors-insert', $validation->getErrors());
    }

    log_message('info', 'Validación exitosa.');

    // Cargar el helper personalizado
    helper('finance_helper');

    // Recoger y limpiar datos del formulario
    $principalRaw = $this->request->getPost('principal');
    $rateRaw = $this->request->getPost('rate');

    $balance = filter_var(str_replace(['$', ','], '', $principalRaw), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $rate = filter_var(str_replace(',', '.', $rateRaw), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $balance = is_numeric($balance) ? (float)$balance : 0.0;
    $rate = is_numeric($rate) ? (float)$rate : 0.0;

    $compoundingPeriods = (int)$this->request->getPost('compoundingPeriods');
    $time = (int)$this->request->getPost('time');

    // Calcular el monto final con interés compuesto
    $finalAmount = calculateCompoundInterest($balance, $rate, $compoundingPeriods, $time);

    // Preparar datos para la base de datos
    $data = [
        'name' => $this->request->getPost('name'),
        'last_name' => $this->request->getPost('last_name'),
        'identification' => $this->request->getPost('identification'),
        'email' => $this->request->getPost('email'),
        'role_id' => $this->request->getPost('id_role'),
        'status' => $this->request->getPost('status'),
        'password_hash' => password_hash("SCOPECAPITAL2025", PASSWORD_DEFAULT),
        'balance' => $balance,
        'rate' => $rate,
        'compoundingPeriods' => $compoundingPeriods,
        'time' => $time,
        'principal' => $finalAmount
    ];

    log_message('info', 'Datos recogidos del formulario: ' . json_encode($data));

    try {
        // Insertar en la base de datos
        $model->insert($data);
        log_message('info', 'Consulta ejecutada: ' . $model->db->getLastQuery());
        log_message('info', 'Usuario agregado correctamente en la base de datos.');
        return redirect()->to('/admin/clientmanagement')->with('success', 'Usuario agregado correctamente');
    } catch (\Exception $e) {
        log_message('error', 'Error al insertar usuario: ' . $e->getMessage());
        return redirect()->back()->withInput()->with('errors-insert', ['db_error' => 'No se pudo registrar el usuario.']);
    }
}

    public function updateUser($id)
    {
        log_message('info', 'Starting updateUser() method for user ID: ' . $id);
        
        $model = new ClientManagementModel();
        
        // Define validation rules
        $rules = [
            'name' => 'required|min_length[2]|max_length[70]',
            'last_name' => 'required|min_length[2]|max_length[80]',
            'identification' => "required|numeric|min_length[5]|max_length[20]|is_unique[users.identification,id_user,{$id}]",
            'email' => "required|valid_email|max_length[100]|is_unique[users.email,id_user,{$id}]",
            'phone' => 'required|numeric|min_length[8]|max_length[15]',
            'address' => 'required|max_length[100]',
            'id_role' => 'required|numeric',
            'status' => 'required|in_list[active,inactive]',
        ];
        
        log_message('info', 'Validation rules defined.');
        
        // Validate data
        if (!$this->validate($rules)) {
            log_message('error', 'Validation failed: ' . json_encode(\Config\Services::validation()->getErrors()));
            
            // Retain input and display validation errors
            return redirect()->back()->withInput()->with('errors-edit', \Config\Services::validation()->getErrors());
        }
        
        log_message('info', 'Validation successful.');
        
        // Collect form data
        $data = [
            'name' => $this->request->getPost('name'),
            'last_name' => $this->request->getPost('last_name'),
            'identification' => $this->request->getPost('identification'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'email' => $this->request->getPost('email'),
            'role_id' => $this->request->getPost('id_role'),
            'status' => $this->request->getPost('status'),
        ];
        
        log_message('info', 'Collected form data: ' . json_encode($data));
        
        try {
            // Update user in the database
            $model->update($id, $data);
            log_message('info', 'Executed query: ' . $model->db->getLastQuery());
        
            log_message('info', 'User successfully updated.');
            return redirect()->to('/admin/clientmanagement')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            log_message('error', 'Database error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors-insert', ['db_error' => 'An error occurred while updating the user.']);
        }
    }
    
    
    
    public function deleteUser($id)
    {
        $userModel = new ClientManagementModel();
        try {
            $result = $userModel->delete($id);

            if ($result) {
                return redirect()->to('/admin/clientmanagement')->with('error', 'Usuario eliminado correctamente.');
            } else {
                return redirect()->to('/admin/clientmanagement')->with('error', 'No se pudo eliminar el usuario.');
            }
        } catch (DatabaseException $e) {
            // Manejo del error específico
            if (strpos($e->getMessage(), 'Cannot delete or update a parent row: a foreign key constraint fails') !== false) {
                return redirect()->to('/admin/clientmanagement')->with('error', 'No se puede eliminar el usuario porque está asociado a otros registros o asignación.');
            }

            // Otros errores
            return redirect()->to('admin/clientmanagement')->with('error', 'Ocurrió un error al intentar eliminar el usuario.');
        }

    }
}
