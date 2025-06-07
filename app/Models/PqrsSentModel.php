<?php

namespace App\Models;

use CodeIgniter\Model;

class PqrsSentModel extends Model
{
    protected $table      = 'requests';
    protected $primaryKey = 'id_request';

    protected $allowedFields = ['unique_code','user_id','type_id','status_id', 'description', 'attachment_url', 'created_at',0];
    protected $useTimestamps = false;
}
