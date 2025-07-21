<?php

namespace App\Controllers;

use App\Models\PqrsManagementModel;
use App\Models\ComboBoxModel;
use CodeIgniter\Controller;
use App\Libraries\SendEmail;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PQRS Request Rejected</title>
</head>
<body style="font-family: 'Nunito', sans-serif; background-color: #f5f7fa; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <div style="background-color: #192229; color: #e74c3c; padding: 20px; text-align: center;">
            <img src="https://i.imgur.com/ZQcJdWg.png" style="max-height: 60px; margin-bottom: 10px;" alt="Scope Capital">
            <h2 style="margin: 0;">❌ PQRS Rejected</h2>
        </div>
        <div style="padding: 30px;">
            <p>Hello <strong>{$nombre} {$apellido}</strong>,</p>
            <p>We regret to inform you that your PQRS request has been <strong>rejected</strong>. Please find the details below:</p>
            <div style="background-color: #fceaea; padding: 15px; font-size: 18px; font-weight: bold; border-left: 5px solid #e74c3c; margin: 20px 0;">
                Request Code: {$codigo}
            </div>
            <p><strong>Current Status:</strong> Rejected ❌</p>
            <p>If you need more information regarding this decision, feel free to contact our support team.</p>
            <p style="margin-top: 30px;">Thank you for your understanding,</p>
            <p>The Scope Capital Team</p>
        </div>
        <div style="background-color: #192229; text-align: center; padding: 15px; font-size: 12px; color: #e74c3c;">
            © {$year} Scope Capital. All rights reserved.
        </div>
    </div>
</body>
</html>
HTML;


        // Enviar correo
        $email = new SendEmail();
        $email->send($emailUsuario, 'PQRS Request Rejected', $message);

       return redirect()->back()->with('message', 'Your request has been rejected and a notification email has been sent.');

    }
    public function detailsRequest()
    {
        $id = $this->request->getPost('id');
        log_message('info', 'ID recibido en detailsRequest: ' . $id);
        $pqrsModel = new PqrsManagementModel();
        $requestDetails = $pqrsModel->getDetailedRequests($id);
return $this->response->setJSON([
    'status' => 'ok',
    'message' => 'Request details retrieved successfully.',
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
    return redirect()->back()->with('error', 'Request not found.');
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
    return redirect()->back()->with('error', 'The request could not be updated.');
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PQRS Request Resolved</title>
</head>
<body style="font-family: 'Nunito', sans-serif; background-color: #f5f7fa; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <div style="background-color: #192229; color: #27ae60; padding: 20px; text-align: center;">
            <img src="https://i.imgur.com/ZQcJdWg.png" style="max-height: 60px; margin-bottom: 10px;" alt="Scope Capital">
            <h2 style="margin: 0;">✅ PQRS Resolved</h2>
        </div>
        <div style="padding: 30px;">
            <p>Hello <strong>{$nombre} {$apellido}</strong>,</p>
            <p>We are pleased to inform you that your PQRS request has been <strong>successfully resolved</strong>. Here are the details:</p>
            <div style="background-color: #eafaf1; padding: 15px; font-size: 18px; font-weight: bold; border-left: 5px solid #27ae60; margin: 20px 0;">
                Request Code: {$codigo}
            </div>
            <p><strong>Current Status:</strong> Resolved ✅</p>
            <p><strong>Response from our team:</strong></p>
            <div style="background-color: #f9f9f9; padding: 15px; border: 1px solid #ddd; border-radius: 5px; margin-top: 10px;">
                {$mensajeRespuesta}
            </div>
            <p style="margin-top: 30px;">Thank you for trusting us,</p>
            <p>The Scope Capital Team</p>
        </div>
        <div style="background-color: #192229; text-align: center; padding: 15px; font-size: 12px; color: #27ae60;">
            © {$year} Scope Capital. All rights reserved.
        </div>
    </div>
</body>
</html>
HTML;


        // Enviar correo
        $email = new SendEmail();
        $enviado = $email->send($emailUsuario, 'PQRS Request Resolved', $message);

       if (!$enviado) {
    return redirect()->back()->with('error', 'The request was resolved, but the email could not be sent.');
}

return redirect()->back()->with('success', 'The request was resolved and the email was sent successfully.');
    }
  public function exportToExcel()
{
    $pqrsModels = new PqrsManagementModel();
    $pqrsData = $pqrsModels->getDetailedRequests() ?? [];

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Encabezados
$headers = [
    'Unique Code',
    'Email',
    'Request Type',
    'Status',
    'Attachment',
    'Description',
    'Response',
    'Creation Date',
    'Last Update'
];

    $sheet->fromArray($headers, null, 'A1');

    // Estilos para el encabezado
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
    $sheet->getStyle('A1:I1')->applyFromArray($headerStyle);
    $sheet->getRowDimension(1)->setRowHeight(25);

    // Agregar filas de datos
    $row = 2;
    foreach ($pqrsData as $item) {
        $sheet->setCellValue('A' . $row, $item->unique_code);
        $sheet->setCellValue('B' . $row, $item->email);
        $sheet->setCellValue('C' . $row, $item->type);
        $sheet->setCellValue('D' . $row, $item->status);
        $sheet->setCellValue('E' . $row, $item->attachment_url ?? 'Sin adjunto');
        $sheet->setCellValue('F' . $row, $item->description);
        $sheet->setCellValue('G' . $row, $item->response ?? 'Sin respuesta');
        $sheet->setCellValue('H' . $row, $item->created_at);
        $sheet->setCellValue('I' . $row, $item->updated_at);
        $row++;
    }

    // Ajustar ancho de columnas automáticamente
    foreach (range('A', 'I') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Generar y descargar archivo
    $writer = new Xlsx($spreadsheet);
    $filename = 'pqrs_export_' . date('Ymd_His') . '.xlsx';

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
}
