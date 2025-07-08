<?php
namespace App\Controllers;

use App\Models\ClientManagementModel;
use App\Models\ComboBoxModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\SendEmail;
use App\Models\HistoryTransactionModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
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
            'phone' => 'required|numeric|min_length[8]|max_length[15]',
            'address' => 'required|max_length[100]',
            'id_role' => 'required|numeric',
            'status' => 'required|in_list[active,inactive]',


            'principal' => 'required',
            'rate' => 'required',
            'compoundingPeriods' => 'required',
            'time' => 'required',
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

        $balance = is_numeric($balance) ? (float) $balance : 0.0;
        $rate = is_numeric($rate) ? (float) $rate : 0.0;

        $compoundingPeriods = (int) $this->request->getPost('compoundingPeriods');
        $time = (int) $this->request->getPost('time');

        // Calcular el monto final con interés compuesto
        $finalAmount = calculateCompoundInterest($balance, $rate, $compoundingPeriods, $time);

        // Preparar datos para la base de datos
        $data = [
            // Pestaña: Client
            'name' => $this->request->getPost('name'),
            'last_name' => $this->request->getPost('last_name'),
            'identification' => $this->request->getPost('identification'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'trust' => $this->request->getPost('trust'),
            'email_del_trust' => $this->request->getPost('email_del_trust'),
            'telephone_del_trust' => $this->request->getPost('telephone_del_trust'),

            // Pestaña: Banking
            'bank' => $this->request->getPost('bank'),
            'swift' => $this->request->getPost('swift'),
            'aba' => $this->request->getPost('aba'),
            'iban' => $this->request->getPost('iban'),
            'account' => $this->request->getPost('account'),
            // Pestaña: System
            'role_id' => $this->request->getPost('id_role'),
            'status' => $this->request->getPost('status'),
            'password_hash' => password_hash('SCOPECAPITAL2025', PASSWORD_DEFAULT),

            // Pestaña: Financial
            'balance' => $finalAmount,
            'rate' => $rate,
            'compoundingPeriods' => $compoundingPeriods,
            'time' => $time,
            'principal' => $balance,

            // Pestaña: Agreement
            'agreement' => $this->request->getPost('agreement'),
            'number' => $this->request->getPost('number'),
            'letter' => $this->request->getPost('letter'),
            'policy' => $this->request->getPost('policy'),
            'date_from' => $this->request->getPost('date_from'),
            'date_to' => $this->request->getPost('date_to'),
            'approved_by' => $this->request->getPost('approved_by'),
            'approved_date' => $this->request->getPost('approved_date'),
            'date_registration' => date('Y-m-d H:i:s'),

        ];

        log_message('info', 'Datos recogidos del formulario: ' . json_encode($data));

        try {
            $history = new HistoryTransactionModel();

            // Primero insertar usuario (u otro modelo)
            $model->insert($data);
            $insertedId = $model->insertID(); // ← aquí obtienes el ID

            // Luego registrar en historial
            $history->insert([
                'user_id' => $insertedId,
                'amount' => $finalAmount,
                'transaction_type' => 'loan',
                'transaction_date' => date('Y-m-d H:i:s')
            ]);

            $email = new SendEmail();


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



            return redirect()->to('/admin/clientmanagement')->with('success', 'Usuario agregado correctamente');
        } catch (\Exception $e) {
            log_message('error', 'Error al insertar usuario: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors-insert', ['db_error' => 'No se pudo registrar el usuario.']);
        }
    }


    public function getUserById($id)
    {
        log_message('info', 'Iniciando el método getUserById() con ID: ' . $id);
        $model = new ClientManagementModel();
        $user = $model->find($id);

        if ($user) {
            log_message('info', 'Usuario encontrado: ' . json_encode($user));
            return $this->response->setJSON($user);
        } else {
            log_message('error', 'Usuario no encontrado con ID: ' . $id);
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                ->setJSON(['status' => 'error', 'message' => 'Usuario no encontrado']);
        }
    }
public function updateUser($id)
{
    $model = new ClientManagementModel();

    $rules = [
        'name' => 'required|min_length[2]|max_length[70]',
        'last_name' => 'required|min_length[2]|max_length[80]',
        'identification' => 'required|numeric|min_length[5]|max_length[20]',
        'email' => 'required|valid_email|max_length[100]',
        'phone' => 'required|numeric|min_length[8]|max_length[15]',
        'address' => 'required|max_length[100]',
        'status' => 'required|in_list[active,inactive]',
        'principal' => 'required|numeric',
        'rate' => 'required|numeric',
        'compoundingPeriods' => 'required|integer',
        'time' => 'required|integer',
        'balance' => 'permit_empty|decimal',
        'bank' => 'permit_empty|max_length[100]',
        'swift' => 'permit_empty|alpha_numeric|max_length[20]',
        'aba' => 'permit_empty|numeric|max_length[15]',
        'iban' => 'permit_empty|alpha_numeric|max_length[34]',
        'account' => 'permit_empty|max_length[30]',
        'trust' => 'permit_empty|max_length[100]',
        'email_del_trust' => 'permit_empty|valid_email',
        'telephone_del_trust' => 'permit_empty|numeric|max_length[20]',
        'agreement' => 'permit_empty|max_length[100]',
        'number' => 'permit_empty|max_length[20]',
        'letter' => 'permit_empty|max_length[5]',
        'policy' => 'permit_empty|max_length[50]',
        'date_from' => 'permit_empty|valid_date',
        'date_to' => 'permit_empty|valid_date',
        'approved_by' => 'permit_empty|max_length[100]',
        'approved_date' => 'permit_empty|valid_date'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors-edit', \Config\Services::validation()->getErrors());
    }

    $data = [
        'name' => $this->request->getPost('name'),
        'last_name' => $this->request->getPost('last_name'),
        'identification' => $this->request->getPost('identification'),
        'email' => $this->request->getPost('email'),
        'phone' => $this->request->getPost('phone'),
        'address' => $this->request->getPost('address'),
        'status' => $this->request->getPost('status'),

        // Financieros
        'bank' => $this->request->getPost('bank'),
        'swift' => $this->request->getPost('swift'),
        'aba' => $this->request->getPost('aba'),
        'iban' => $this->request->getPost('iban'),
        'account' => $this->request->getPost('account'),
        'balance' => (float) $this->request->getPost('balance'),
        'rate' => (float) $this->request->getPost('rate'),
        'compoundingPeriods' => (int) $this->request->getPost('compoundingPeriods'),
        'time' => (int) $this->request->getPost('time'),
        'principal' => (float) $this->request->getPost('principal'),

        // Confianza y acuerdo
        'trust' => $this->request->getPost('trust'),
        'email_del_trust' => $this->request->getPost('email_del_trust'),
        'telephone_del_trust' => $this->request->getPost('telephone_del_trust'),
        'agreement' => $this->request->getPost('agreement'),
        'number' => $this->request->getPost('number'),
        'letter' => $this->request->getPost('letter'),
        'policy' => $this->request->getPost('policy'),
        'date_from' => $this->request->getPost('date_from'),
        'date_to' => $this->request->getPost('date_to'),
        'approved_by' => $this->request->getPost('approved_by'),
        'approved_date' => $this->request->getPost('approved_date'),
    ];

    try {
        $currentData = $model->find($id);

        // Campos para recalcular balance
        $recalculationFields = ['rate', 'principal', 'compoundingPeriods', 'time'];
        $recalculationChanged = false;

        foreach ($recalculationFields as $field) {
            $new = round((float) $data[$field], 4);
            $old = round((float) ($currentData[$field] ?? 0), 4);

            if ($new !== $old) {
                $recalculationChanged = true;
                break;
            }
        }

        $balanceNew = round((float) $data['balance'], 4);
        $balanceOld = round((float) ($currentData['balance'] ?? 0), 4);

        if ($recalculationChanged && $balanceNew === $balanceOld) {
            log_message('error', 'Intento de actualización sin recalcular balance.');
            return redirect()->back()->withInput()->with('errors-edit', [
                'recalc' => 'Debes recalcular el balance antes de guardar.'
            ]);
        }

        // Registrar historial si cambió balance
        if ($balanceNew !== $balanceOld) {
            $history = new HistoryTransactionModel();
            $history->insert([
                'user_id' => $id,
                'amount' => $balanceNew,
                'transaction_type' => 'loan',
                'transaction_date' => date('Y-m-d H:i:s')
            ]);
        }

        // Actualizar
        $model->update($id, $data);

        return redirect()->to('/admin/clientmanagement')->with('success', 'Usuario actualizado correctamente.');
    } catch (\Exception $e) {
        log_message('error', "Error al actualizar usuario ID $id: " . $e->getMessage());
        return redirect()->back()->withInput()->with('errors-edit', [
            'db_error' => 'Ocurrió un error al actualizar el usuario.'
        ]);
    }
}




    public function deleteUser($id)
    {
        $userModel = new ClientManagementModel();
        try {
            $result = $userModel->delete($id);

            if ($result) {
                return redirect()->to('/admin/clientmanagement')->with('error', 'Cliente eliminado correctamente.');
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

   public function recalculateCompoundInterest()
{
    helper('finance_helper');

    $principalRaw = $this->request->getPost('principal');
    $rateRaw = $this->request->getPost('rate');

    $balance = filter_var(str_replace(['$', ','], '', $principalRaw), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $rate = filter_var(str_replace(',', '.', $rateRaw), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $balance = is_numeric($balance) ? (float) $balance : 0.0;
    $rate = is_numeric($rate) ? (float) $rate : 0.0;

    $compoundingPeriods = (int) $this->request->getPost('compoundingPeriods');
    $time = (int) $this->request->getPost('time');

    $result = calculateCompoundInterest($balance, $rate, $compoundingPeriods, $time);

    return $this->response->setJSON([
        'success' => true,
        'finalAmount' => $result
    ]);
}

}
