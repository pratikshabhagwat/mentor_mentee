<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CallsModel;

class Calls extends ResourceController
{
    use ResponseTrait;

    // all users
    public function index()
    {
        $model = new CallsModel();
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
        $model = new CallsModel();
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
        $model = new CallsModel();
        $data = [
            'kiosk_id' => $this->request->getVar('kiosk_id'),
            'dr_id' => $this->request->getVar('dr_id'),
            'patient_id' => $this->request->getVar('patient_id'),
            'call_link' => $this->request->getVar('call_link'),
            'cretated_at' => date("Y-m-d h:i:sa"),
            'updated_at' => date("Y-m-d h:i:sa"),
            'call_start' => $this->request->getVar('call_start'),
            'call_end' => $this->request->getVar('call_end')
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
        $model = new CallsModel();
    
        $data = [
            'kiosk_id' => $this->request->getVar('kiosk_id'),
            'dr_id' => $this->request->getVar('dr_id'),
            'patient_id' => $this->request->getVar('patient_id'),
            'call_link' => $this->request->getVar('call_link'),
            'updated_at' => date(),
            'call_start' => $this->request->getVar('call_start'),
            'call_end' => $this->request->getVar('call_end')
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
        $model = new CallsModel();
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
