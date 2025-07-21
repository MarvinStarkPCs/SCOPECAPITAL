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
    
        // Get SMTP configuration from the database
        $smtpConfigData = $ConfigurationModel->where('config_key', 'smtp_config')->first();
    
        // Decode the config_value which is stored as JSON
        $smtpConfig = isset($smtpConfigData['config_value']) && !empty($smtpConfigData['config_value']) 
            ? json_decode($smtpConfigData['config_value'], true) 
            : [];

        // Pass the decoded data to the view
        return view('aside/setting/setting', ['stmp_config' => $smtpConfig]);
    }
    
    // Save SMTP configuration
    public function saveSMTPConfig()
    {
        // Validation rules
        $rules = [
            'host' => 'required|valid_url',
            'port' => 'required|numeric|min_length[2]|max_length[5]',
            'username' => 'required|valid_email',
            'smtp_password' => 'required|min_length[6]'
        ];

        // Validate form data
        if (!$this->validate($rules)) {
            // If validation fails, redirect back with errors
            return redirect()->back()->withInput()->with('errors-insert', $this->validator->getErrors());
        }

        // Get form data
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
        log_message('info', 'Data sent to update SMTP: ' . print_r($data, true));

        // Try to save the configuration
        try {
            $ConfigurationModel = new ConfigurationModel();
            $ConfigurationModel->updateSMTPConfig($data);

            // Log: Successfully updated configuration
            $this->logger->info('SMTP configuration successfully updated.');
            return redirect()->to('/admin/setting')->with('success', 'SMTP configuration updated successfully.');

        } catch (\Exception $e) {
            // Log: Error updating configuration
            $this->logger->error('Error updating configuration: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was a problem updating the configuration.');
        }
    }
}
