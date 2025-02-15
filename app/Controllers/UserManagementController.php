<?php
namespace App\Controllers;

use App\Models\UserManagementModel;
use App\Models\ComboBoxModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserManagementController extends BaseController
{
    public function index()
    {
        $userModel = new UserManagementModel();
        $roleModel = new ComboBoxModel();

        $data = [

            'users' => $userModel->getUsers() ?? [],
            'roles' => $roleModel->getTableData('roles') ?? []
        ];

        return view('security/UserManagement/UserManagement', $data);
    }

    public function show($id)
    {
        $userModel = new UsermanagementModel();
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
        $model = new UserManagementModel();

        // Definir reglas de validación
        $rules = [
            'name' => 'required|min_length[2]|max_length[70]',
            'last_name' => 'required|min_length[2]|max_length[80]',
            'identification' => 'required|numeric|min_length[5]|max_length[20]|is_unique[users.identification]',
            'email' => 'required|valid_email|max_length[100]|is_unique[users.email]',
            'phone' => 'required|numeric|min_length[8]|max_length[15]',
            'address' => 'required|max_length[100]',
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

        // Recoger los datos del formulario
        $data = [
            'name' => $this->request->getPost('name'),
            'last_name' => $this->request->getPost('last_name'),
            'identification' => $this->request->getPost('identification'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'email' => $this->request->getPost('email'),
            'role_id' => $this->request->getPost('id_role'),
            'status' => $this->request->getPost('status'),
            'password_hash' => password_hash("SCOPECAPITAL2025", PASSWORD_DEFAULT),
        ];

        log_message('info', 'Datos recogidos del formulario: ' . json_encode($data));

        try {
            // Insertar en la base de datos
            $model->insert($data);
            log_message('info', 'Consulta ejecutada: ' . $model->db->getLastQuery());

            log_message('info', 'Usuario agregado correctamente en la base de datos.');
            return redirect()->to('/admin/usermanagement')->with('success', 'Usuario agregado correctamente');
        } catch (\Exception $e) {
            log_message('error', 'Error al insertar usuario: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors-insert', ['db_error' => 'No se pudo registrar el usuario.']);
        }
    }
    public function updateUser($id)
    {
        log_message('info', 'Starting updateUser() method for user ID: ' . $id);
        
        $model = new UserManagementModel();
        
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
            return redirect()->to('/admin/usermanagement')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            log_message('error', 'Database error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors-insert', ['db_error' => 'An error occurred while updating the user.']);
        }
    }
    
    
    


    public function deleteUser($id)
    {
        $userModel = new UserManagementModel();
        try {
            $result = $userModel->delete($id);

            if ($result) {
                return redirect()->to('/admin/usermanagement')->with('success', 'Usuario eliminado correctamente.');
            } else {
                return redirect()->to('/admin/usermanagement')->with('error', 'No se pudo eliminar el usuario.');
            }
        } catch (DatabaseException $e) {
            // Manejo del error específico
            if (strpos($e->getMessage(), 'Cannot delete or update a parent row: a foreign key constraint fails') !== false) {
                return redirect()->to('/admin/usermanagement')->with('error', 'No se puede eliminar el usuario porque está asociado a otros registros o asignación.');
            }

            // Otros errores
            return redirect()->to('admin/usermanagement')->with('error', 'Ocurrió un error al intentar eliminar el usuario.');
        }

    }
}
