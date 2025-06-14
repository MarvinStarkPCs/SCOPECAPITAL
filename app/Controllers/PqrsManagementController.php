<?php
namespace App\Controllers;
use App\Models\PqrsManagementModel;
use App\Models\ComboBoxModel;
use CodeIgniter\Controller;
use App\Libraries\SendEmail;

class PqrsManagementController extends Controller
{
    public function index()
    {
        $pqrsModel = new PqrsManagementModel();

        $data = [
            'requests' => $pqrsModel->getDetailedRequests(),
            'requestTypes' => (new ComboBoxModel())->getTableData('request_types') ?? [],  // Llama al método del modelo
            'requestStatuses' => (new ComboBoxModel())->getTableData('request_statuses') ?? [],  // Llama al método del modelo
        ];

        return view('system/pqrsmanagement/pqrsmanagement', $data);
    }
    public function filterRequests()
    {
        $startDate = $this->request->getPost('fechaInicio');
        $endDate = $this->request->getPost('fechaFin');
        $statusId = $this->request->getPost('estadoPQRS');
        $typeId = $this->request->getPost('tipoPQRS');

        // Llama al modelo y aplica los filtros
        $pqrsModel = new PqrsManagementModel();
        $filteredData = $pqrsModel->getFilteredRequests($startDate, $endDate, $statusId, $typeId);
        // Devuelve los datos como JSON sin renderizar vista
        return $this->response->setJSON([
            'status' => 'ok',
            'message' => 'Datos filtrados correctamente.',
            'data' => $filteredData
        ]);
    }
    public function cancelrequest($id)
    {
        $pqrsModel = new PqrsManagementModel();
        $info = $pqrsModel->getEmailAndCodeByRequestId($id);

        if (!$info) {
            return redirect()->back()->with('error', 'No se encontró la solicitud.');
        }

        // Actualizar estado
        $pqrsModel->update($id, ['status_id' => 3, 'updated_at' => date('Y-m-d H:i:s')]);

        // Preparar correo
        $emailUsuario = $info->email;
        $codigo = $info->unique_code;
        $nombre = $info->name;
        $apellido = $info->last_name;
        $year = date('Y');

        $message = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud PQRS Rechazada</title>
</head>
<body style="font-family: 'Nunito', sans-serif; background-color: #f5f7fa; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <div style="background-color: #192229; color: #e74c3c; padding: 20px; text-align: center;">
            <img src="https://i.imgur.com/ZQcJdWg.png" style="max-height: 60px; margin-bottom: 10px;" alt="Scope Capital">
            <h2 style="margin: 0;">❌ PQRS Rechazada</h2>
        </div>
        <div style="padding: 30px;">
            <p>Hola <strong>{$nombre} {$apellido}</strong>,</p>
            <p>Lamentamos informarte que tu solicitud PQRS ha sido <strong>rechazada</strong>. Aquí tienes los detalles:</p>
            <div style="background-color: #fceaea; padding: 15px; font-size: 18px; font-weight: bold; border-left: 5px solid #e74c3c; margin: 20px 0;">
                Código de Solicitud: {$codigo}
            </div>
            <p><strong>Estado actual:</strong> Rechazada ❌</p>
            <p>Si deseas más información sobre esta decisión, puedes comunicarte con nuestro equipo de soporte.</p>
            <p style="margin-top: 30px;">Gracias por tu comprensión,</p>
            <p>El equipo de Scope Capital</p>
        </div>
        <div style="background-color: #192229; text-align: center; padding: 15px; font-size: 12px; color: #e74c3c;">
            © {$year} Scope Capital. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
HTML;

        // Enviar correo
        $email = new SendEmail();
        $email->send($emailUsuario, 'Solicitud PQRS Rechazada', $message);

        return redirect()->back()->with('message', 'Solicitud rechazada y correo enviado.');
    }
    public function detailsRequest()
    {
        $id = $this->request->getPost('id');
        log_message('info', 'ID recibido en detailsRequest: ' . $id);
        $pqrsModel = new PqrsManagementModel();
        $requestDetails = $pqrsModel->getDetailedRequests($id);

        return $this->response->setJSON([
            'status' => 'ok',
            'message' => 'Detalles de la solicitud obtenidos correctamente.',
            'data' => $requestDetails
        ]);
    }
public function solveRequest()
{
    $id = $this->request->getPost('id_request');
    $response = $this->request->getPost('response');

    log_message('info', 'ID recibido en solveRequest: ' . $id);
    log_message('info', 'Respuesta recibida: ' . $response);

    $pqrsModel = new PqrsManagementModel();

    // Validar si existe la solicitud antes de actualizar
    $info = $pqrsModel->getEmailAndCodeByRequestId($id);
    if (!$info) {
        return redirect()->back()->with('error', 'No se encontró la solicitud.');
    }

    // Actualizar estado y guardar respuesta
    $updated = $pqrsModel->update($id, [
        'status_id' => 2, // Estado "Resuelto"
        'response' => $response,
        'updated_at' => date('Y-m-d H:i:s')
    ]);
// Obtener instancia de la base de datos
$db = \Config\Database::connect();

// Registrar la consulta en el log
log_message('info', 'Q  : ' . $db->getLastQuery());
    if (!$updated) {
        return redirect()->back()->with('error', 'No se pudo actualizar la solicitud.');
    }

    // Datos para el correo
    $emailUsuario = $info->email;
    $codigo = $info->unique_code;
    $nombre = $info->name;
    $apellido = $info->last_name;
    $mensajeRespuesta = nl2br(htmlspecialchars($response)); // Sanitiza el contenido
    $year = date('Y');

    $message = <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud PQRS Resuelta</title>
</head>
<body style="font-family: 'Nunito', sans-serif; background-color: #f5f7fa; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <div style="background-color: #192229; color: #27ae60; padding: 20px; text-align: center;">
            <img src="https://i.imgur.com/ZQcJdWg.png" style="max-height: 60px; margin-bottom: 10px;" alt="Scope Capital">
            <h2 style="margin: 0;">✅ PQRS Resuelta</h2>
        </div>
        <div style="padding: 30px;">
            <p>Hola <strong>{$nombre} {$apellido}</strong>,</p>
            <p>Nos complace informarte que tu solicitud PQRS ha sido <strong>resuelta</strong>. Aquí tienes los detalles:</p>
            <div style="background-color: #eafaf1; padding: 15px; font-size: 18px; font-weight: bold; border-left: 5px solid #27ae60; margin: 20px 0;">
                Código de Solicitud: {$codigo}
            </div>
            <p><strong>Estado actual:</strong> Resuelta ✅</p>
            <p><strong>Respuesta del equipo:</strong></p>
            <div style="background-color: #f9f9f9; padding: 15px; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px;">
                {$mensajeRespuesta}
            </div>
            <p style="margin-top: 30px;">Gracias por confiar en nosotros,</p>
            <p>El equipo de Scope Capital</p>
        </div>
        <div style="background-color: #192229; text-align: center; padding: 15px; font-size: 12px; color: #27ae60;">
            © {$year} Scope Capital. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
HTML;

    // Enviar correo
    $email = new SendEmail();
    $enviado = $email->send($emailUsuario, 'Solicitud PQRS Resuelta', $message);

    if (!$enviado) {
        return redirect()->back()->with('error', 'La solicitud fue resuelta, pero no se pudo enviar el correo.');
    }

    return redirect()->back()->with('success', 'La solicitud fue resuelta y el correo enviado exitosamente.');
}




}