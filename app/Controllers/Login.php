<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use App\Models\MentorModel;
use App\Models\StudentModel;
use CodeIgniter\API\ResponseTrait;

class Login extends BaseController
{
    use ResponseTrait;
    public function login()
    {
        $model = new LoginModel();
        $data = $this->request->getJson();
        if (!isset($data->email) || !isset($data->password)) {
            $response = [
                "status" => 500,
                "message" => "email or password is missing",
                "data" => null
            ];
            return $this->respond($response);
        }
        $email = $data->email;
        $userData = $model->where("username", $email)->first();
        if (!$userData) {
            $response = [
                "status" => 204,
                "message" => "Account not found",
                "data" => null
            ];
            return $this->respond($response);
        } 
        
        $password = $data->password;
        if (password_verify($password, $userData['password'])) {
            $model->select("user.*,role.name as role_name");
            $model->join("role", "role.id=user.role", "INNER");
            $model->where("username", $email);
            $roleData = $model->first();
            $role= $roleData['role'];
            $profileId=$roleData['profile_id'];
            $usersdata=[];
           if($role==1){
            $studentmodel=new StudentModel();
            $userData=$studentmodel->select("student.*")->where(["id"=>$profileId])->findAll();
           }
           elseif($role==4){
            $mentorModel=new MentorModel();
            $userData=$mentorModel->select("mentor.*")->where(["id"=>$profileId])->findAll();
           }
          
           print_r($userData);
           exit;
            
            if (!$userData) {
                $response = [
                    "status" => 204,
                    "message" => "Something went wrong. Please try again later!",
                    "data" => null
                ];
                return $this->respond($response);
            } 
          else{
                $response = [
                    "status" => 200,
                    "message" => "Login successfull",
                    "data" => $userData
                ];
                 return $this->respond($response);
          }
        }
          $response = [
                "status" => 401,
                "message" => "email or password is incorrect",
                "data" => null
            ];
            return $this->respond($response);
        
    }
}
