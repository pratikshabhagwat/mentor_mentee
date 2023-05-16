<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MentorModel;
use CodeIgniter\API\ResponseTrait;

class Mentor extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $model = new MentorModel();
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
        $model = new MentorModel();
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
        $model = new MentorModel();
        $data = $this->request->getJson();
        $email=$data->email;
        $mobile=$data->contact_no;
        $registrationData=$model->where(["email"=>$email])->orWhere(["contact_no"=>$mobile])->findAll();
        if($registrationData)
        {
            $response = [
                "status" => 204,
                "data" => null,
                "message" => "already registered mentor"
            ];
            return $this->respond($response);
        }

        $mentordata = $model->find($id);

        $usermodel=new UserModel();
        // $role=$data->role;
        $username=$data->email;
        $password=password_hash($data->password,PASSWORD_DEFAULT);
        // $data->password=
        $profile_id=$id;

        $userdata=[
            "role"=>4,
            "username"=>$username,
            "password"=>$password,
            "profile_id"=>$profile_id
        ];
        $userid = $usermodel->insert($userdata);
      
 
        if ($usermodel->errors()) {
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
        $model = new MentorModel();
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
        else{
        $response =
            [
                "status" => 200,
                "message" => "Record fetched successfully",
                "data" => $data
            ];
        return $this->respond($response);
    }
}

    public function delete($id = null)
    {
        $model = new MentorModel();
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
