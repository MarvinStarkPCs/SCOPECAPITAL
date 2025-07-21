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
            'label' => 'Attached File',
            'rules' => 'uploaded[attachment]|max_size[attachment,2048]|ext_in[attachment,jpg,jpeg,png,pdf,doc,docx]',
            'errors' => [
                'uploaded' => 'You must select a file.',
                'max_size' => 'The file must not exceed 2MB.',
                'ext_in' => 'File type not allowed.',
            ]
        ]
    ];

    if (!$this->validate($validationRules)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Please check the information you entered.')
            ->with('validation', $this->validator);
    }

    // Generar código único para la PQRS
    $unique_code = 'REQ-' . strtoupper(bin2hex(random_bytes(3)));

    // Procesar archivo adjunto
    $file = $this->request->getFile('attachment');

    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move(FCPATH . 'upload/pqrs/', $newName);
    } else {
        // En caso que por alguna razón no se haya subido el archivo correctamente
        return redirect()->back()
            ->withInput()
            ->with('error', 'There was a problem uploading the file.');
    }

    // Guardar datos en la base de datos
    $pqrsModel = new PqrsSentModel();
    $pqrsModel->insert([
        'unique_code' => $unique_code,
        'user_id' => session()->get('id_user'),
        'type_id' => $this->request->getPost('type_id'),
        'status_id' => 1, // Estado inicial: Pendiente
        'description' => $this->request->getPost('description'),
        'attachment_url' => $newName,
        'created_at' => date('Y-m-d H:i:s'),
    ]);

    // Enviar correo de confirmación (puedes mantener tu código actual aquí)

    // Redireccionar con mensaje de éxito
    return redirect()
        ->to('/client/pqrs-sent')
        ->with('success', 'PQRS submitted successfully. Please check your email.');
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