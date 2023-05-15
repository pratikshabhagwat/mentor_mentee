<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['first_name','last_name','middle_name','user_name','password','gender','state','state_obj','district','district_obj','block','block_obj','village','village_obj','role_id',
    'is_email_verified','is_anabled'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
    'first_name'=>"required",
    'last_name'=>"required",
    'user_name'=>"required",
    'password'=>"required",
    'gender'=>"required",
    'state'=>"required",
    'district'=>"required",
    'block'=>"required",
    'village'=>"required",
    // 'role'=>"required",
    'is_email_verified'=>"required",
    'is_anabled'=>"required"];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
