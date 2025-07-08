<?php
namespace App\Controllers;

use App\Models\UserManagementModel;
use App\Models\ComboBoxModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\SendEmail;
use CodeIgniter\Database\Exceptions\DatabaseException;

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
            'role_id' => '1',
            'status' => $this->request->getPost('status'),
            'password_hash' => password_hash("SCOPECAPITAL2025", PASSWORD_DEFAULT),
        ];

        log_message('info', 'Datos recogidos del formulario: ' . json_encode($data));

        try {
            // Insertar en la base de datos
            $model->insert($data);
        
            // Crear el objeto SendEmail
            $email = new SendEmail();
        
            // Ruta de la imagen
            // $attachment = [
            //     'path' => FCPATH . 'img/logo_small.png',
            //     'type' => 'image/x-icon',
            //     'name' => 'logo_small.png',
            //     'inline' => true
            // ];        
            // Crear mensaje con CID
            $message = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a Scope Capital</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <link href="' . base_url('assets/fontawesome-free/css/all.min.css') . '" rel="stylesheet" type="text/css">
</head>
<body style="font-family: Nunito, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; background-color: #f5f7fa; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <div style="background-color: #192229; color: #F1C40F; padding: 20px; text-align: center;">
            <img src="https://i.imgur.com/ZQcJdWg.png" style="max-height: 60px; margin-bottom: 10px;">
            <h2 style="margin: 0;">👋 Bienvenido a Scope Capital</h2>
        </div>
        <div style="padding: 30px;">
            <p>Hola <strong>' . esc($data['name']) . ' ' . esc($data['last_name']) . '</strong>,</p>
            <p>Tu cuenta ha sido creada exitosamente. A continuación te compartimos tus credenciales de acceso:</p>
            <ul style="list-style: none; padding: 0;">
                <li><strong>📧 Usuario:</strong> ' . esc($data['email']) . '</li>
                <li><strong>🔒 Contraseña:</strong> SCOPECAPITAL2025</li>
            </ul>
            <p>Puedes iniciar sesión haciendo clic en el siguiente botón:</p>
            <p style="text-align: center;">
                <a href="' . base_url('login') . '" style="background-color: #F1C40F; color: white; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-weight: bold;">Iniciar sesión</a>
            </p>
            <p style="margin-top: 30px;">Gracias por confiar en nosotros,</p>
            <p>El equipo de Scope Capital</p>
        </div>
        <div style="background-color: #192229; text-align: center; padding: 15px; font-size: 12px; color: #F1C40F;">
            © ' . date("Y") . ' Scope Capital. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>';

            
        
            // Enviar el correo
            $email->send($data['email'], 'Bienvenido a Scope Capital', $message);
        
            return redirect()->to('/admin/usermanagement')->with('success', 'Usuario agregado correctamente');
        } catch (\Exception $e) {
            log_message('error', 'Error al agregar usuario: ' . $e->getMessage());
            return redirect()->to('/admin/usermanagement')->with('error', 'Error al agregar el usuario');
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
                return redirect()->to('/admin/usermanagement')->with('error', 'Usuario eliminado correctamente.');
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
