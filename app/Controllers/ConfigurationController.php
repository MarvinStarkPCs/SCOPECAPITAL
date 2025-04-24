<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ConfigurationModel;
use CodeIgniter\Controller;

class ConfigurationController extends BaseController
{
    public function index()
    {
        $ConfigurationModel = new ConfigurationModel();
    
        // Obtener la configuración SMTP desde la base de datos
        $stmp_config_data = $ConfigurationModel->where('config_key', 'smtp_config')->first();
    
        // Decodificar el valor de config_value que es un JSON
        $stmp_config = isset($stmp_config_data['config_value']) && !empty($stmp_config_data['config_value']) 
        ? json_decode($stmp_config_data['config_value'], true) 
        : [];

        // Pasar los datos decodificados a la vista
        return view('aside/setting/setting', ['stmp_config' => $stmp_config]);
    }
    
    
    // Guardar configuración SMTP
    public function saveSMTPConfig()
    {
        // Reglas de validación
        $rules = [
            'host' => 'required|valid_url',
            'port' => 'required|numeric|min_length[2]|max_length[5]',
            'username' => 'required|valid_email',
            'smtp_password' => 'required|min_length[6]'
        ];

        // Validar los datos del formulario
        if (!$this->validate($rules)) {
            // Si la validación falla, redirige de vuelta con los errores
            return redirect()->back()->withInput()->with('errors-insert', $this->validator->getErrors());
        }

        // Tomar los datos del formulario
        $data = [
            'config_key' => 'smtp_config',
            'config_value' => json_encode([
                'host' => $this->request->getPost('host'),
                'username' => $this->request->getPost('username'),
                'port' => $this->request->getPost('port'),
                'smtp_password' => $this->request->getPost('smtp_password'),
                'security' => $this->request->getPost('security')
            ]),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        log_message('info', 'Datos enviados para actualizar SMTP: ' . print_r($data, true));

        // Verificar si la configuración fue guardada exitosamente
        try {
            $ConfigurationModel = new ConfigurationModel();
            $ConfigurationModel->updateSMTPConfig($data);

            // Log: Éxito al actualizar la configuración
            $this->logger->info('Configuración SMTP actualizada exitosamente.');
            return redirect()->to('/admin/setting')->with('success', 'Configuración SMTP actualizada con éxito.');

        } catch (\Exception $e) {
            // Log: Error al actualizar la configuración
            $this->logger->error('Error al actualizar la configuración: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un problema al actualizar la configuración.');
        }
    }
}
