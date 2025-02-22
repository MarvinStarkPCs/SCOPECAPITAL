<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use App\Models\SettingModel;

class Email extends BaseConfig
{
    public string $fromEmail  = '';
    public string $fromName   = '';
    public string $recipients = '';

    public string $userAgent = 'CodeIgniter';
    public string $protocol = 'smtp';
    public string $SMTPHost = '';
    public string $SMTPUser = '';
    public string $SMTPPass = '';
    public int $SMTPPort = 25;
    public int $SMTPTimeout = 5;
    public bool $SMTPKeepAlive = false;
    public string $SMTPCrypto = 'tls';
    public bool $wordWrap = true;
    public int $wrapChars = 76;
    public string $mailType = 'html';
    public string $charset = 'UTF-8';
    public bool $validate = false;
    public int $priority = 3;
    public string $CRLF = "\r\n";
    public string $newline = "\r\n";
    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;
    public bool $DSN = false;

    public function __construct()
    {
        parent::__construct();
        
        // Cargar configuración desde la base de datos
        $settingsModel = new SettingModel();
        $smtpConfig = $settingsModel->getSMTPConfig(); // Método que debes crear en tu modelo

        if ($smtpConfig) {
            // Asigna los valores desde la base de datos
            $this->SMTPHost = $smtpConfig['host'];
            $this->SMTPUser = $smtpConfig['usuario_smtp'];
            $this->SMTPPass = $smtpConfig['clave_smtp'];
            $this->SMTPPort = (int)$smtpConfig['puerto'];
        }
    }
}
