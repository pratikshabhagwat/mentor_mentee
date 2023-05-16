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
        $data = $model->select("student.*,class.class_name,stream.stream_name")->join("class", "class.id=student.class", "INNER")->join("stream", "stream.id=student.stream", "INNER")->orderBy('id', 'DESC')->findAll();

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
        $data = $model->select("student.*,class.class_name,stream.stream_name")->join("class", "class.id=student.class", "INNER")->join("stream", "stream.id=student.stream", "INNER")->find($id);
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
        $email = $data->email_id;
        $mobile = $data->contact_no;
        $registrationData = $model->where(["email_id" => $email])->orWhere(["contact_no" => $mobile])->findAll();
        if ($registrationData) {
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

        $usermodel = new UserModel();
        // $role=$data->role;
        $username = $data->email_id;
        $password = password_hash($data->password, PASSWORD_DEFAULT);
        // $data->password=
        $profile_id = $id;

        $userdata = [
            "role" => 1,
            "username" => $username,
            "password" => $password,
            "profile_id" => $profile_id
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
        $newdata = [];
        $newdata = array_merge($studentsdata, $usersdata);
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
        $data = $model->select("student.*,class.class_name,stream.stream_name")->join("class", "class.id=student.class", "INNER")->join("stream", "stream.id=student.stream", "INNER")->find($id);
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
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Student deleted successfully'
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



    public function studentReport()
    {
        $model=new StudentModel();
        $data=$this->request->getJSON();
        $school=$data->school_id;
        $class=$data->class_id;
        $stream=$data->stream_id;
        $specialization=$data->specialization_id;
        $board=$data->board_id;

            
        $whereArr = [];  
        $groupBy=[];  
        $selectArr = [];
        
    
        if ($school == 0 && $class == 0&& $stream==0 && $specialization==0 && $board==0) {  
            $selectArr = [
                "student.*",
                "school.name"
               
              ];
              $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->findAll();
        }   
        elseif ($school != 0 && $class == 0&& $stream==0 && $specialization==0 && $board==0) {
            $whereArr['school_id'] = $school;
            $selectArr = [
              "student.*",
              "school.name"
             
            ];
            $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->where($whereArr)->findAll();
        }       
        elseif ($school != 0 && $class != 0&& $stream==0 && $specialization==0 && $board==0){
            $whereArr['school_id'] = $school;
            $whereArr['class'] = $class;
            $selectArr = [
               "student.*",
               "school.name",
             "class.class_name"            
            ];
            $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->join("class","class.id=student.class","INNER")->where($whereArr)->findAll();
         }
        elseif ($school != 0 && $class != 0&& $stream!=0 && $specialization==0 && $board==0) {
            $whereArr['school_id'] = $school;
            $whereArr['class'] = $class;
            $whereArr['stream'] = $stream;
            // $groupBy = "anganwadi_id";
            $selectArr = [
                "student.*",
                "school.name",
                "class.class_name",
                "stream.stream_name"
            ];
            $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->join("class","class.id=student.class","INNER")->join("stream","stream.id=student.stream","INNER")->where($whereArr)->findAll();
        }


        elseif ($school != 0 && $class != 0&& $stream!=0 && $specialization!=0 && $board==0) {
            $whereArr['school_id'] = $school;
            $whereArr['class'] = $class;
            $whereArr['stream'] = $stream;
            $whereArr['specialization'] = $specialization;
            // $groupBy = "anganwadi_id";
            $selectArr = [
                "student.*",
                "school.name",
                "class.class_name",
                "stream.stream_name",
                "stream_specialization.specialization_name"
            ];
            $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->join("class","class.id=student.class","INNER")->join("stream","stream.id=student.stream","INNER")->join("stream_specialization","stream_specialization.id=student.specialization","INNER")->where($whereArr)->findAll();
        
        }

        elseif ($school != 0 && $class != 0&& $stream!=0 && $specialization!=0 && $board!=0) {
            $whereArr['school_id'] = $school;
            $whereArr['class'] = $class;
            $whereArr['stream'] = $stream;
            $whereArr['specialization'] = $specialization;
            $whereArr['board'] = $board;

            // $groupBy = "anganwadi_id";
            $selectArr = [
                "student.*",
                "school.name",
                "class.class_name",
                "stream.stream_name",
                "stream_specialization.specialization_name",
                "board.board_name"
            ];
        $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->join("class","class.id=student.class","INNER")->join("stream","stream.id=student.stream","INNER")->join("stream_specialization","stream_specialization.id=student.specialization","INNER")->join("board","board.id=student.board")->where($whereArr)->findAll();     
     
        }
        else{
            $response=[
                "status"=>500,
                "data"=>[],
                 "error"=>"something went wrong"
            ];
            return $this->respond($response);
        }
      
        // $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->join("class","class.id=student.class","INNER")->join("stream","stream.id=student.stream","INNER")->join("stream_specialization","stream_specialization.id=student.specialization","INNER")->join("board","board.id=student.board")->where($whereArr)->findAll();     
     
        if(!empty($studentdata)){
            $response=[
                "status"=>200,
                "data"=>$studentdata,
                "error"=>null
            ];
            return $this->respond($response);
        }
        else{
            $response=[
                "status"=>204,
                "data"=>"no records found",
                "error"=>null
            ];
            return $this->respond($response);
        }

    }

    }



