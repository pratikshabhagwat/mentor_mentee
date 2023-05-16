<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SpecializationModel;
use CodeIgniter\API\ResponseTrait;

class Specialization extends BaseController
{
    use ResponseTrait;
    public function index()
    {        
        $model = new SpecializationModel();
        $data = $model->orderBy('id', 'DESC')->findAll();
        if ($data != null) {
            $response = [
                "status" => 200,
                "data" => $data,
                "error" => null
            ];
            return $this->respond($response);
        } else {
            $response = [
                "status" => 204,
                "data" => "No Records Found",
                "error" => null
            ];
            return $this->respond($response);
        }
    }
}
