<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'roles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['role_name', 'business_view', 'business_add', 'business_edit', 'business_delete', 'category_view', 'category_add', 'category_edit', 'category_delete', 'category_group_view', 'category_group_add', 'category_group_edit', 'category_group_delete', 'company_view', 'company_add', 'company_edit', 'company_delete', 'customer_view', 'customer_add', 'customer_edit', 'customer_delete', 'personal_view', 'personal_add', 'personal_edit', 'personal_delete', 'product_view', 'product_add', 'product_edit', 'product_delete', 'shg_profile_view', 'shg_profile_add', 'shg_profile_edit', 'shg_profile_delete', 'profiles_view', 'profiles_add', 'profiles_edit', 'profiles_delete', 'vendor_view', 'vendor_add', 'vendor_edit', 'vendor_delete'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = ["role_name"=>"required", 'business_view'=>"required|numeric", 'business_add'=>"required|numeric", 'business_edit'=>"required|numeric", 'business_delete'=>"required|numeric", 'category_view'=>"required|numeric", 'category_add'=>"required|numeric", 'category_edit'=>"required|numeric", 'category_delete'=>"required|numeric", 'category_group_view'=>"required|numeric", 'category_group_add'=>"required|numeric", 'category_group_edit'=>"required|numeric", 'category_group_delete'=>"required|numeric", 'company_view'=>"required|numeric", 'company_add'=>"required|numeric", 'company_edit'=>"required|numeric", 'company_delete'=>"required|numeric", 'customer_view'=>"required|numeric", 'customer_add'=>"required|numeric", 'customer_edit'=>"required|numeric", 'customer_delete'=>"required|numeric", 'personal_view'=>"required|numeric", 'personal_add'=>"required|numeric", 'personal_edit'=>"required|numeric", 'personal_delete'=>"required|numeric", 'product_view'=>"required|numeric", 'product_add'=>"required|numeric", 'product_edit'=>"required|numeric", 'product_delete'=>"required|numeric", 'shg_profile_view'=>"required|numeric", 'shg_profile_add'=>"required|numeric", 'shg_profile_edit'=>"required|numeric", 'shg_profile_delete'=>"required|numeric", 'profiles_view'=>"required|numeric", 'profiles_add'=>"required|numeric", 'profiles_edit'=>"required|numeric", 'profiles_delete'=>"required|numeric", 'vendor_view'=>"required|numeric", 'vendor_add'=>"required|numeric", 'vendor_edit'=>"required|numeric", 'vendor_delete'=>"required|numeric"];
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
