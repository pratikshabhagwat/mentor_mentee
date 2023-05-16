<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminProfileModel;
use App\Models\SchoolModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class School extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $model = new SchoolModel();
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
    public function show($id)
    {
        $model = new SchoolModel();
        $data = $model->find($id);
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
        $model = new SchoolModel();
        $data = $this->request->getJson();
        $id = $model->insert($data);
        if ($model->errors()) {
            $response = [
                "status" => 500,
                "data" => null,
                "message" => $model->errors()
            ];
            return $this->respond($response);
        }
        $schooldata = $model->find($id);
        $adminarr=[
            "f_name"=>$data->f_name,
            "m_name"=>$data->m_name,
            "l_name"=>$data->l_name,
            "contact_no"=>$data->contact_no,
            "email"=>$data->email,
            "school_id"=>$schooldata['id']
        ];
        
        $adminModel=new AdminProfileModel();
        
        $adminid = $adminModel->insert($adminarr);
        if ($adminModel->errors()) {
            $response = [
                "status" => 500,
                "data" => null,
                "message" => $adminModel->errors()
            ];
            return $this->respond($response);
        }
        $admindata = $adminModel->find($adminid);
        
       
        $userArr=[
            "username"=>$data->email,
            "password"=>password_hash($data->password,PASSWORD_DEFAULT),
            "role"=>2,
            "profile_id"=>$admindata['id']
        ];
        
        $userModel=new UserModel();
        $userid = $userModel->insert($userArr);
        if ($userModel->errors()) {
            $response = [
                "status" => 500,
                "data" => null,
                "message" => $userModel->errors()
            ];
            return $this->respond($response);
        }
        $userdata = $userModel->find($userid);
       
        $newarr=[];
        $newarr=array_merge($schooldata,$admindata,$userdata );
        
        if ($newarr == null) {
            $response = [
                "status" => "204",
                "data" => null,
                "message" => "Something went wrong!"
            ];
            return $this->respond($response);
        }
        $response = [
            "status" => "200",
            "data" => $newarr,
            "message" => "Record inserted successfully"
        ];
        return $this->respond($response);
    }


    public function update($id)
    {
        $model = new SchoolModel();
        $data = $this->request->getJson();
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
        $model = new SchoolModel();
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
