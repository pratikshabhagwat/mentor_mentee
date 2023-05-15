<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'schools';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["name", "state", "state_obj", "district", "district_obj", "block", "block_obj", "village", "village_obj", "address"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        "name" => "required",
        "state" => "required",
        "state_obj" => "required",
        "district" => "required",
        "district_obj" => "required",
        "block" => "required",
        "block_obj" => "required",
        "village" => "required",
        "village_obj" => "required",
        "address" => "required"
    ];
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
