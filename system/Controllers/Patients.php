<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\PatientsModel;

class Patients extends ResourceController
{
    use ResponseTrait;

    // all users
    public function index()
    {
        $model = new UserModel();
        $data = $model->Where(['role' => '2'])->orderBy('id', 'DESC')->findAll();

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
        $data = $this->GetPatientData($id);

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
        $model = new UserModel();
        $patientsModel = new PatientsModel();

        $data = $this->request->getJson();
        if(!isset($data->password) || !isset($data->contact_number) || !isset($data->email))
        {
            return $this->respond([
                "status"=>204,
                "message"=>"Password is required",
                "data"=>null,
            ]);
        }
        $password=$data->password;
        $data->password = password_hash($password, PASSWORD_DEFAULT);

        $data->is_email_verified = true;
        $data->is_anabled = true;
        $id = $model->insert($data);
        if ($model->errors()) {
            $response = [
                "status" => 504,
                "data" => null,
                "error" => $model->errors(),
            ];
            return $this->respond($response);
        }
        
        $patientData = [
            'dob' => $data->dob,
            'user_id' => $id,
            'contact_number' => $data->contact_number,
            'email' => $data->email,
        ];
        $patientId = $patientsModel->insert($patientData);
        if ($patientsModel->errors()) {
            $response = [
                "status" => 504,
                "data" => null,
                "error" => $patientsModel->errors(),
            ];
            return $this->respond($response);
        }
        $data = $this->GetPatientData($id);
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
        $model = new UserModel();
        $password = $this->request->getVar('password');
        $data = [
            'email' => $this->request->getVar('email'),
            'profile_id' => $this->request->getVar('profile_id')
        ];
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);

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
        $model = new UserModel();
        $data = $model->where('id', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'User deleted successfully'
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
    public function GetPatientData($id = null)
    {
      $model = new UserModel();
      $data=$model->select("user.*,patient.*")->join("patient","patient.user_id=user.id")->where("user.id",$id)->first();
        return $data;
    }
}
