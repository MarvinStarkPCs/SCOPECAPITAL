<?php
namespace App\Controllers;

use App\Models\UserManagementModel;
use App\Models\ComboBoxModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\SendEmail;
use CodeIgniter\Database\Exceptions\DatabaseException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
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



    
public function exportToExcel()
{
    $userModel = new UserManagementModel();
    $users = $userModel->getUsers() ?? [];

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

 $headers = [
        'Full Name', 'Identification', 'Email', 'Phone', 'Address',
        'Date Registration', 'Status', 'Role',
    ];    $sheet->fromArray($headers, null, 'A1');

    // Estilo del encabezado (solo color de fondo amarillo)
    $headerStyle = [
        'font' => [
            'bold' => true,
            'color' => ['rgb' => '000000'],
            'size' => 12
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'f1c40f']
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER
        ]
    ];
    $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);
    $sheet->getRowDimension(1)->setRowHeight(25);

    // Llenar filas de datos (sin estilo especial)
    $row = 2;
    foreach ($users as $user) {
   $sheet->setCellValue('A' . $row, $user['name'] . ' ' . $user['last_name']);
        $sheet->setCellValue('B' . $row, $user['identification']);
        $sheet->setCellValue('C' . $row, $user['email']);
        $sheet->setCellValue('D' . $row, $user['phone']);
        $sheet->setCellValue('E' . $row, $user['address']);
        $sheet->setCellValue('F' . $row, $user['date_registration']);
        $sheet->setCellValue('G' . $row, $user['status']);
        $sheet->setCellValue('H' . $row, $user['role_name']);
     

        $row++;
    }

    // Autoajustar columnas
    foreach (range('A', 'H') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Descargar archivo
    $writer = new Xlsx($spreadsheet);
    $filename = 'users_export_' . date('Ymd_His') . '.xlsx';

    return $this->response
        ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
        ->setHeader('Content-Disposition', 'attachment;filename="' . $filename . '"')
        ->setHeader('Cache-Control', 'max-age=0')
        ->setBody($this->getSpreadsheetContent($writer));
}

    private function getSpreadsheetContent($writer)
    {
        ob_start();
        $writer->save('php://output');
        return ob_get_clean();
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Scope Capital</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <link href="' . base_url('assets/fontawesome-free/css/all.min.css') . '" rel="stylesheet" type="text/css">
</head>
<body style="font-family: Nunito, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; background-color: #f5f7fa; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <div style="background-color: #192229; color: #F1C40F; padding: 20px; text-align: center;">
            <img src="https://i.imgur.com/ZQcJdWg.png" style="max-height: 60px; margin-bottom: 10px;">
            <h2 style="margin: 0;">👋 Welcome to Scope Capital</h2>
        </div>
        <div style="padding: 30px;">
            <p>Hello <strong>' . esc($data['name']) . ' ' . esc($data['last_name']) . '</strong>,</p>
            <p>Your account has been successfully created. Here are your login credentials:</p>
            <ul style="list-style: none; padding: 0;">
                <li><strong>📧 Username:</strong> ' . esc($data['email']) . '</li>
                <li><strong>🔒 Password:</strong> SCOPECAPITAL2025</li>
            </ul>
            <p>You can log in by clicking the button below:</p>
            <p style="text-align: center;">
                <a href="' . base_url('login') . '" style="background-color: #F1C40F; color: white; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-weight: bold;">Log In</a>
            </p>
            <p style="margin-top: 30px;">Thank you for trusting us,</p>
            <p>The Scope Capital Team</p>
        </div>
        <div style="background-color: #192229; text-align: center; padding: 15px; font-size: 12px; color: #F1C40F;">
            © ' . date("Y") . ' Scope Capital. All rights reserved.
        </div>
    </div>
</body>
</html>';


            
        
            // Enviar el correo
$email->send(to: $data['email'], subject: 'Welcome to Scope Capital', message: $message);
        
       return redirect()->to('/admin/usermanagement')->with('success', 'User added successfully');
} catch (\Exception $e) {
    log_message('error', 'Error adding user: ' . $e->getMessage());
    return redirect()->to('/admin/usermanagement')->with('error', 'Error adding the user');
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
            return redirect()->to('/admin/usermanagement')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->to('/admin/usermanagement')->with('error', 'Could not delete the user.');
        }
    } catch (DatabaseException $e) {
        // Specific error handling
        if (strpos($e->getMessage(), 'Cannot delete or update a parent row: a foreign key constraint fails') !== false) {
            return redirect()->to('/admin/usermanagement')->with('error', 'Cannot delete the user because it is associated with other records or assignments.');
        }

        // Other errors
        return redirect()->to('/admin/usermanagement')->with('error', 'An error occurred while trying to delete the user.');
    }
}

    
}
