<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DoctorProfileModel;
use App\Models\UserModel;


class DoctorProfile extends BaseController
{
    use \CodeIgniter\API\ResponseTrait;
    public function index()
    {
    }
    public function create()
    {
        $data = $this->request->getJson();
        $model = new DoctorProfileModel();
        $userController = new User;
        $data->is_email_verified=true;
        $data->is_anabled=true;
        $data->role=1;
         $userData = $userController->register($data);
        if($userData['status']!=200)
        {
            return $this->respond($userData);
        }
      
        if (!isset($data->qualification) ||  !isset($data->specialization) || !isset($data->languages) || !isset($data->counseling)) {
            $response = [
                "status" => 204,
                "message" => "Please provide qualification,specialization,languages,counselling fieds",
                "data" => null,
            ];
            return $this->respond($response);
        }
        $data->qualification = json_encode($data->qualification);
        $data->specialization = json_encode($data->specialization);
        $data->languages = json_encode($data->languages);
        $data->counseling = json_encode($data->counseling);
        $data->user_id=$userData['user_id'];
        $id = $model->insert($data);
        if ($model->errors()) {
            $response = [
                "status" => 504,
                "success" => false,
                "message" => $model->errors(),
            ];
            return $this->respond($response);
        }
        // echo "in";
        $data=$this->getDooctorProfile($userData['user_id']);
    
        if ($data == null) {
            $response = [
                "status" => 204,
                "success" => false,
                "message" => "Something went wrong",
            ];
            return $this->respond($response);
        }
        $response = [
            "status" => 200,
            "message" => "Data inserted successfully",
            "data" => $data,
        ];

        return $this->respond($response);
    }
    public function getDooctorProfile($userid)
    {
        $doctorModel=new DoctorProfileModel();
        $data=$doctorModel->select("doctor_profile.*,user.*")->join("user","user.id=doctor_profile.user_id","inner")->where("user.id",$userid)->first();
        return $data;
    }
    public function update($id)
    {
        $data = $this->request->getJson();

        $model = new DoctorProfileModel();
        if (isset($data->qualification)) {
            $data->qualification = json_encode($data->qualification);
        }
        if (isset($data->specialization)) {
            $data->specialization = json_encode($data->specialization);
        }
        if (isset($data->languages)) {
            $data->languages = json_encode($data->languages);
        }
        if (isset($data->geoLocation)) {
            $data->geoLocation = json_encode($data->geoLocation);
        }
        if (isset($data->counseling)) {
            $data->counseling = json_encode($data->counseling);
        }

        $model->where(['user_id' => $id])->update(null, $data);
        if ($model->errors()) {
            return $this->respond($model->errors());
        }

        $data = $model->where(['user_id' => $id])->findAll();
        return $this->respond($data);
    }
    public function show($id)
    {
        $model = new DoctorProfileModel();


        $data = $model->where(["user_id" => $id])->findAll();
        if ($data == null) {
            $response = [
                "status" => "success",
                "data" => null,
                "message" => "No records found"
            ];
            return $this->respond($response);
        }
        $response = [
            "status" => "success",
            "data" => $data,
            "message" => "No records found"
        ];
        return $this->respond($response);
    }
    public function updateState($id)
    {
        $status = $this->request->getJsonVar('isOnline');
        $model = new DoctorProfileModel();
        // $model->where(['user_id' => $id])->set("isOnline", 1);
        $model->where(['user_id' => $id])->update(null, array("isonline" => $status));
        $userModel = new UserModel();
        $userData['email'] = $userModel->where(['id' => $id])->findColumn("email");
        $userData['status'] = $model->where(['user_id' => $id])->findColumn("isonline");
        return $this->respond($userData);
    }
}
