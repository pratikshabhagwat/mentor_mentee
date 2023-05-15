<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StreamModel;
use CodeIgniter\API\ResponseTrait;

class Stream extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $model = new StreamModel();
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
