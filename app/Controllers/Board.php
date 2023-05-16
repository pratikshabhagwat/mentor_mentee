<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BoardModel;
use CodeIgniter\API\ResponseTrait;

class Board extends BaseController
{
    use ResponseTrait;
    public function index()
    {
    $model = new BoardModel();
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
