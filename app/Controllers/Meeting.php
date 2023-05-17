<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MeetingModel;
use App\Models\StudentModel;
use CodeIgniter\API\ResponseTrait;

class Meeting extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new MeetingModel();
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
        $model = new MeetingModel();
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
        $model = new MeetingModel();
        $data = $this->request->getJson();
        if (isset($data->atendee)) {
            $data->atendee = json_encode($data->atendee);
        }
        // $url = "mentor-mentee-" . uniqid();
        $id = $model->insert($data);
        // print_r($data);
        // exit;
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
        $model = new MeetingModel();
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
        $model = new MeetingModel();
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



    
    public function studentfilter()
    {
        $model=new StudentModel();
        $data=$this->request->getJSON();
        $district=$data->district;
        $block=$data->block;
        $class=$data->class_id;
        $stream=$data->stream_id;

            
        $whereArr = [];  
        $groupBy=[];  
        $selectArr = [];
        
    
        if ($district == 0 && $block==0 && $stream==0 && $class == 0 ) {  
            $selectArr = [
                "student.*",
                "school.name"
               
              ];
              $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->findAll();
        }   
        elseif ($district != 0 && $block==0 && $stream==0 && $class == 0 ) {
            $whereArr['student.district'] = $district;
            $selectArr = [
              "student.*",
              "school.name"
             
            ];
            $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->where($whereArr)->findAll();
        }       
        elseif ($district != 0 && $block!=0 && $stream==0 && $class == 0 ){
            $whereArr['student.block'] = $block;
            $whereArr['student.district'] = $district;
            $selectArr = [
               "student.*",
               "school.name",     
            ];
            $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->where($whereArr)->findAll();
         }
        elseif ($district != 0 && $block!=0 && $stream!=0 && $class == 0 ) {
            $whereArr['student.block'] = $block;
            $whereArr['student.district'] = $district;   
            $whereArr['student.stream'] = $stream;
            
            $selectArr = [
                "student.*",
                "school.name"
            ];
            $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->where($whereArr)->findAll();
        }


        elseif ($district != 0 && $block!=0 && $stream!=0 && $class != 0 ) {
            $whereArr['student.block'] = $block;
            $whereArr['student.district'] = $district;
            $whereArr['class'] = $class;
            $whereArr['stream'] = $stream;
           
            // $groupBy = "anganwadi_id";
            $selectArr = [
                "student.*",
                "school.name",
                // "class.class_name",
                // "stream.stream_name",
            ];
            $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->where($whereArr)->findAll();
        
        }

        elseif ($district != 0 && $block!=0 && $stream==0 && $class != 0 ) {
            $whereArr['student.block'] = $block;
            $whereArr['student.district'] = $district;
            $whereArr['class'] = $class;

            // $groupBy = "anganwadi_id";
            $selectArr = [
                "student.*",
                "school.name",
                // "class.class_name",
            ];
        $studentdata = $model->select($selectArr)->join("school","school.id=student.school_id","INNER")->where($whereArr)->findAll();     
     
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
