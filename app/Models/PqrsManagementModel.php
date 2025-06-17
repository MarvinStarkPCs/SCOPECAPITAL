<?php
namespace App\Models;

use CodeIgniter\Model;

class PqrsManagementModel extends Model
{
    protected $table = 'requests';
    protected $primaryKey = 'id_request';
    protected $allowedFields = [
        'unique_code',
        'user_id',
        'type_id',
        'status_id',
        'description',
        'response',
        'attachment_url',
        'created_at',
        'updated_at'
    ];
    protected $returnType = 'array';

public function getDetailedRequests(int $requestId = null)
{
    $builder = $this->db->table('requests r')
        ->select('
            r.id_request,
            r.unique_code,
            u.email,
            rt.id_type,
            rt.name as type,
            rs.id_status,
            rs.name as status,
            r.attachment_url,
            r.description,
            r.response,
            r.created_at,
            r.updated_at
        ')
        ->join('request_statuses rs', 'r.status_id = rs.id_status')
        ->join('request_types rt', 'r.type_id = rt.id_type')
        ->join('users u', 'r.user_id = u.id_user');

    if ($requestId !== null) {
        $builder->where('r.id_request', $requestId);
    }

    return $builder->get()->getResult();
}
public function getRequestsByUser(int $userId)
{
    $builder = $this->db->table('requests r')
        ->select('
            r.id_request,
            r.unique_code,
            u.email,
            rt.name as type,
            rt.id_type,
            rs.name as status,
            rs.id_status,
            r.attachment_url,
            r.description,
            r.response,
            r.created_at,
            r.updated_at
        ')
        ->join('request_statuses rs', 'r.status_id = rs.id_status')
        ->join('request_types rt', 'r.type_id = rt.id_type')
        ->join('users u', 'r.user_id = u.id_user')
        ->where('r.user_id', $userId)
        ->orderBy('r.created_at', 'DESC');

    log_message('info', 'Consultando solicitudes del usuario ID: ' . $userId);

    return $builder->get()->getResultArray();
}

public function getFilteredRequests($start_date = null, $end_date = null, $status_id = null, $type_id = null)
{
    $builder = $this->db->table('requests r');
    $builder->select('
        r.id_request,
        r.unique_code,
        u.email,
        r.type_id,
        rt.name as type,
        r.status_id,
        rs.name as status,
        r.attachment_url,
        r.description,
        r.created_at
    ');
    $builder->join('request_statuses rs', 'r.status_id = rs.id_status');
    $builder->join('request_types rt', 'r.type_id = rt.id_type');
    $builder->join('users u', 'r.user_id = u.id_user');

    // Solo armar grupo OR si hay al menos uno
    if (!empty($start_date) && !empty($end_date) || !empty($status_id) || !empty($type_id)) {
        $builder->groupStart();

        if (!empty($start_date) && !empty($end_date)) {
            $builder->where('r.created_at >=', $start_date);
            $builder->where('r.created_at <=', $end_date);
        }

        if (!empty($status_id)) {
            $builder->orWhere('r.status_id', $status_id);
        }

        if (!empty($type_id)) {
            $builder->orWhere('r.type_id', $type_id);
        }

        $builder->groupEnd();
    }

    $query = $builder->get();
    return $query->getResult();
}
public function getEmailAndCodeByRequestId($id_request)
{
    return $this->db->table('requests r')
        ->select('r.unique_code, u.email, u.name, u.last_name')
        ->join('users u', 'r.user_id = u.id_user')
        ->where('r.id_request', $id_request)
        ->get()
        ->getRow();
}



}
