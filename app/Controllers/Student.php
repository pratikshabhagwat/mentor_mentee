<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Student extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $model = new StudentModel();
        $data = $model->select("student.*,class.class_name,stream.stream_name")->join("class","class.id=student.class","INNER")->join("stream","stream.id=student.stream","INNER")->orderBy('id', 'DESC')->findAll();
       
        // $model->join("role", "role.id=user.role", "INNER");
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
        $model = new StudentModel();
        $data = $model->select("student.*,class.class_name,stream.stream_name")->join("class","class.id=student.class","INNER")->join("stream","stream.id=student.stream","INNER")->find($id);
        // $data = $model->find($id);
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
        $model = new StudentModel();
        $data = $this->request->getJson();
        $email=$data->email_id;
        $mobile=$data->contact_no;
        $registrationData=$model->where(["email_id"=>$email])->orWhere(["contact_no"=>$mobile])->findAll();
        if($registrationData)
        {
            $response = [
                "status" => 204,
                "data" => null,
                "message" => "already registered student"
            ];
            return $this->respond($response);
        }
        
        $id = $model->insert($data);

        if ($model->errors()) {
            $response = [
                "status" => 500,
                "data" => null,
                "message" => $model->errors()
            ];
            return $this->respond($response);
        }
        $studentsdata = $model->find($id);
       
        $usermodel=new UserModel();
        // $role=$data->role;
        $username=$data->email_id;
        $password=password_hash($data->password,PASSWORD_DEFAULT);
        // $data->password=
        $profile_id=$id;

        $userdata=[
            "role"=>1,
            "username"=>$username,
            "password"=>$password,
            "profile_id"=>$profile_id
        ];
        $userid = $usermodel->insert($userdata);
      
        if ($usermodel->errors()) {
            $response = [
                "status" => 500,
                "data" => null,
                "message" => $usermodel->errors()
            ];
            return $this->respond($response);
        }
        $usersdata = $usermodel->find($userid); 
        // print_r($usersdata);
        // exit;
        $newdata=[];
        $newdata=array_merge($studentsdata,$usersdata);
        // $newdata = $model->select("student.*,class.class_name")->join("class","class.id=student.class","INNER")->array_merge($studentsdata,$usersdata);

        if ($newdata == null) {
            $response = [
                "status" => "204",
                "data" => null,
                "message" => "Something went wrong!"
            ];
            return $this->respond($response);
        }
        $response = [
            "status" => "200",
            "data" => $newdata,
            "message" => "Record inserted successfully"
        ];
        return $this->respond($response);
    }


    public function update($id)
    {
        $model = new StudentModel();
        $data = $this->request->getJson();
        $model->update($id, $data);
        $data = $model->select("student.*,class.class_name,stream.stream_name")->join("class","class.id=student.class","INNER")->join("stream","stream.id=student.stream","INNER")->find($id);
        // $data = $model->find($id);
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
        $model = new StudentModel();
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

