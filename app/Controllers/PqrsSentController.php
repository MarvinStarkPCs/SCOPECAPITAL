<?php

namespace App\Controllers;
use App\Models\ComboBoxModel;
use App\Models\PqrsSentModel;
use CodeIgniter\Controller;
use App\Libraries\SendEmail;
use App\Models\PqrsManagementModel;

class PqrsSentController extends Controller
{
    public function index()
    {
        $request_types = new ComboBoxModel();
        $data = [
            'request_types' => $request_types->getTableData('request_types') ?? [],
        ];
        // Vista para otros usuarios
        return view('system/pqrsclient/pqrsclient', $data);
    }

    public function save()
    {
        $validationRules = [
            'type_id' => 'required|is_natural_no_zero',
            'description' => 'required|min_length[10]',
            'attachment' => [
                'label' => 'Archivo adjunto',
                'rules' => 'uploaded[attachment]|max_size[attachment,2048]|ext_in[attachment,jpg,jpeg,png,pdf,doc,docx]',
                'errors' => [
                    'uploaded' => 'Debe seleccionar un archivo.',
                    'max_size' => 'El archivo no debe superar los 2MB.',
                    'ext_in' => 'Tipo de archivo no permitido.',
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Verifica los datos ingresados.')
                ->with('validation', $this->validator);
        }

        // Generar código único
        $unique_code = 'REQ-' . strtoupper(bin2hex(random_bytes(3)));

        // Procesar archivo
        $file = $this->request->getFile('attachment');
        $newName = $file->getRandomName(); // Nombre único
        $file->move(FCPATH . 'upload/pqrs/', $newName);
        log_message('info', 'Archivo subido: ' . $newName);

        // Guardar en la base de datos
        $pqrsModel = new PqrsSentModel();
        $pqrsModel->insert([
            'unique_code' => $unique_code,
            'user_id' => session()->get('id_user'), // Asumiendo que el ID del usuario está en la sesión
            'type_id' => $this->request->getPost('type_id'),
            'status_id' => 1, // Asumiendo que el estado inicial es "Pendiente"
            'description' => $this->request->getPost('description'),
            'attachment_url' => $newName,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $email = new SendEmail();
        $session = session();
        $data = [
            'name' => $session->get('name'),
            'last_name' => $session->get('last_name'),
            'email' => $session->get('email'),
        ];
        $year = date('Y');

        $codigo = $unique_code;


        $message = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud PQRS Recibida</title>
</head>
<body style="font-family: 'Nunito', sans-serif; background-color: #f5f7fa; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <div style="background-color: #192229; color: #F1C40F; padding: 20px; text-align: center;">
            <img src="https://i.imgur.com/ZQcJdWg.png" style="max-height: 60px; margin-bottom: 10px;" alt="Scope Capital">
            <h2 style="margin: 0;">📩 PQRS Recibida</h2>
        </div>
        <div style="padding: 30px;">
            <p>Hola <strong>{$data['name']} {$data['last_name']}</strong>,</p>
            <p>Hemos recibido tu solicitud PQRS correctamente. Tu solicitud ha sido registrada con el siguiente código:</p>
            <div style="background-color: #f1f1f1; padding: 15px; font-size: 18px; font-weight: bold; border-left: 5px solid #F1C40F; margin: 20px 0;">
                Código: {$codigo}
            </div>
            <p><strong>Estado actual:</strong> Pendiente ⏳</p>
            <p>Nos pondremos en contacto contigo si se requiere información adicional o una actualización del estado.</p>
            <p style="margin-top: 30px;">Gracias por confiar en nosotros,</p>
            <p>El equipo de Scope Capital</p>
        </div>
        <div style="background-color: #192229; text-align: center; padding: 15px; font-size: 12px; color: #F1C40F;">
            © {$year} Scope Capital. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
HTML;


        $emailUsuario = $session->get('email'); // Asegúrate de que se guarda con esa clave
        $email->send($emailUsuario, 'Hemos recibido tu PQRS', $message);

        log_message('info', 'Consulta INSERT ejecutada: ' . $pqrsModel->db->getLastQuery());

        // Redireccionar con mensaje y código único
        return redirect()
            ->to('/client/pqrs-sent')
            ->with('success', 'PQRS enviada correctamente Revisa tu correo.');
    }

public function view()
{
    $session = session();

    // Verificar si hay un role_id en la sesión
    $id_user = $session->get('id_user');
 

    $pqrsModel = new PqrsManagementModel();

    // Asumiendo que PqrsManagementModel es un método del modelo
    $pqrs = $pqrsModel->getRequestsByUser($id_user);
log_message('info', 'Datos obtenidos: ' . print_r($pqrs, true));
    // Validación si no hay resultados
    if (empty($pqrs)) {
        return redirect()->to('/client/pqrs-sent')->with('error', 'No tienes PQRS registradas.');
    }

    // Cargar la vista con los datos
    return view('system/pqrsclient/pqrsclientview', ['pqrs' => $pqrs]);
}



    
}