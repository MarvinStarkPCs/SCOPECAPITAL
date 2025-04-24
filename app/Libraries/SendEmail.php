<?php
namespace App\Libraries;

use Config\Services;
use App\Models\ConfigurationModel;

class SendEmail
{
    protected $email;
    protected $ConfigurationModel;

    public function __construct()
    {
        $this->email = Services::email();
        $this->ConfigurationModel = new ConfigurationModel();
    }

    public function send($to, $subject, $message, $attachment = null)
    {
        // Obtener configuración SMTP desde la base de datos
        $settings = $this->ConfigurationModel->getEmailSettings();
        log_message('info', 'Configuración SMTP obtenida en librari: ' . print_r($settings, true));
    
        // Validar que los datos necesarios existan
        if (
            empty($settings['host']) || empty($settings['username']) || empty($settings['smtp_password']) ||
            empty($settings['port']) || empty($settings['security'])
        ) {
            log_message('error', 'Faltan campos requeridos en la configuración SMTP.');
            return false;
        }
    
        // Configuración del correo
        $config = [
            'protocol'   => 'smtp',
            'SMTPHost'   => $settings['host'],
            'SMTPUser'   => $settings['username'],
            'SMTPPass'   => $settings['smtp_password'],
            'SMTPPort'   => (int) $settings['port'],
            'SMTPCrypto' => $settings['security'],
            'mailType'   => 'html',
            'charset'    => 'UTF-8',
            'newline'    => "\r\n",
            'CRLF'       => "\r\n"
        ];
    
        // Inicializar con la configuración personalizada
        $this->email->initialize($config);
    
        // Asignar destinatario y contenido
        $this->email->setFrom($settings['username'], 'SCOPECAPITAL'); // Aquí se usa el username como from_email
        $this->email->setTo($to);
        $this->email->setSubject($subject);
        $this->email->setMessage($message);
    
        // Si se pasa un archivo adjunto, agregarlo
        if ($attachment) {
            if (isset($attachment['inline']) && $attachment['inline']) {
                $this->email->attach($attachment['path'], $attachment['type'], $attachment['name'], 'inline');
            } else {
                $this->email->attach($attachment['path'], $attachment['type'], $attachment['name']);
            }
        }
    
        // Enviar y retornar resultado
        if ($this->email->send()) {
            return true;
        } else {
            log_message('error', 'Error al enviar el correo: ' . $this->email->printDebugger(['headers']));
            return false;
        }
    }
}
