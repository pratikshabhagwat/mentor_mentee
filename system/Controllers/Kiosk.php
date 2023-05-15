<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\KioskModel;

class Kiosk extends ResourceController
{
    use ResponseTrait;

    // all users
    public function index()
    {
        $model = new KioskModel();
        $data = $model->orderBy('id', 'DESC')->findAll();

        if ($data != null) {
            $response = [
                "status" => 200,
                "data" => $data,
                'error'    => null,
            ];
        } else {
            $response = [
                "status" => 204,
                "data" => "No records found",
                'error'    => null,
            ];
        }
        return $this->respond($response);
    }

    public function show($id = null)
    {
        $model = new KioskModel();
        $data = $model->Where(['id' => $id])->first();
      
        if ($data != null) {
            $response = [
                "status" => 200,
                "data" => $data,
                'error'    => null,
            ];
        } else {
            $response = [
                "status" => 204,
                "data" => "No records found",
                'error'    => null,
            ];
        }
        return $this->respond($response);
    }

    // create
    public function create()
    {
        $model = new KioskModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'state' => $this->request->getVar('state'),
            'district' => $this->request->getVar('district'),
            'block' => $this->request->getVar('block'),
            'local_body' => $this->request->getVar('local_body'),
            'address' => $this->request->getVar('address'),
            'zip_code' => $this->request->getVar('zip_code')
        ];
       

        $id = $model->insert($data);
        $data =  $model->find($id);

        if ($data != null) {
            $response = [
                "status" => 200,
                "data" => $data,
                'error'    => null,
            ];
        } else {
            $response = [
                "status" => 204,
                "data" => "No records found",
                'error'    => null,
            ];
        }
        return $this->respond($response);
    }

    public function update($id = null)
    {
        $model = new KioskModel();
    
        $data = [
            'name' => $this->request->getVar('name'),
            'state' => $this->request->getVar('state'),
            'district' => $this->request->getVar('district'),
            'block' => $this->request->getVar('block'),
            'local_body' => $this->request->getVar('local_body'),
            'address' => $this->request->getVar('address'),
            'zip_code' => $this->request->getVar('zip_code')
        ];
        $model->update($id, $data);
        $data = $model->find($id);
        if ($data != null) {
            $response = [
                "status" => 200,
                "data" => $data,
                'error'    => null,
            ];
        } else {
            $response = [
                "status" => 204,
                "data" => "No records found",
                'error'    => null,
            ];
        }
        return $this->respond($response);
    }
    // delete
    public function delete($id = null)
    {
        $model = new KioskModel();
        $data = $model->where('id', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Kiosk deleted successfully'
                ]
            ];
        } else {
            $response = [
                'status'   => 504,
                'error'    => null,
                'messages' => [
                    'success' => 'Something went wrong! Please try again later'
                ]
            ];
        }
        return $this->respond($response);
    }
   
}
