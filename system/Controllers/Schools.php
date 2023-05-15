<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SchoolsModel;
use CodeIgniter\API\ResponseTrait;

class Schools extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $model = new SchoolsModel();
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
    public function create()
    {
        $model = new SchoolsModel();
        $data = $this->request->getJson();
        $demographic = new Demographic;
       print_r($demographic->getState(27));
        exit;
        $id = $model->insert($data);
        if ($model->errors()) {
            $response = [
                "status" => 500,
                "data" => null,
                "message" => $model->errors()
            ];
            return $this->respond($response);
        }
        $data = $model->find($id);
        if ($data == null) {
            $response = [
                "status" => "204",
                "data" => null,
                "message" => "Something went wrong!"
            ];
            return $this->respond($response);
        }
        $response = [
            "status" => "200",
            "data" => $data,
            "message" => "Record inserted successfully"
        ];
        return $this->respond($response);
    }
    public function update($id)
    {
        $model = new SchoolsModel();
        $data = $this->request->getJson();
        if (isset($data->medicines)) {
            $data->medicines = json_encode($data->medicines, true);
        }
        $model->update($id, $data);
        $data = $model->find($id);
        if ($data == null) {
            $response =
                [
                    "status" => 500,
                    "data" => null,
                    "message" => "Something went wrong!",
                ];
            return $this->respond($response);
        }
        $response =
            [
                "status" => 200,
                "message" => "Record fetched successfully",
                "data" => $data
            ];
        return $this->respond($response);
    }
    public function delete($id = null)
    {
        $model = new SchoolsModel();
        $data = $model->where('id', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                "status"   => 200,
                'error'    => null,
                'messages' => [
                    'response' => 'Record successfully deleted'
                ]
            ];
            return $this->respond($response);
        } else {
            $response = [
                "status"   => 500,
                'error'    => null,
                'messages' => [
                    'response' => 'Something went wrong! Please try again later'
                ]
            ];
        }
        return $this->respond($response);
    }
}
