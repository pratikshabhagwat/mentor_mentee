<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RolesModel;

class Roles extends BaseController
{
    use \CodeIgniter\Api\ResponseTrait;
    public function index(){
        $model = new RolesModel();
        $data['roles'] = $model->orderBy('id', 'DESC')->findAll();
          
        if ($data!=null) {
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
          $model = new RolesModel();
          $data = $model->Where(['id' => $id])->findAll();
          if ($data!=null) {
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

    public function create()
    {

        $data = $this->request->getJson();
        $model = new RolesModel();
        $id=$model->insert($data);
        if($model->errors())
        {
            $response=[
                "status"=>400,
                "message"=>$model->errors(),
            ];
            return $this->respond($response);
        }
        if($id!=null)
        {
            $data=$model->find($id);
            $response=[
                "status"=>200,
                "message"=>"Record added successfully",
                "data"=>$data,
            ];
            return $this->respond($response);
        }
        else
        {
            $response=[
                "status"=>500,
                "message"=>"Internal server error, Please try again later",
            ];
            return $this->respond($response);
        }
      
    }

    public function update($id)
    {
        $data=$this->request->getJSON();
        $model= new RolesModel();
        if($model->update($id,$data))
        {
            $data=$model->find($id);
            if($data==null)
            {
                $response=[
                    "status"=>200,
                    "message"=>"No records found",
                    "data"=>"No data",
                ];
                return $this->respond($response);
            }
            $response=[
                "status"=>200,
                "message"=>"Record updated successfully",
                "data"=>$data,
            ];
            return $this->respond($response);
        }
        else if($model->errors())
        {
            $response=[
                "status"=>400,
                "message"=>$model->errors(),
            ];
            return $this->respond($response);
        }
        else
        {
            $response=[
                "status"=>500,
                "message"=>"Internal server error, Please try again later",
            ];
            return $this->respond($response);
        }
    }
        // delete
        public function delete($id = null){
            $model = new RolesModel();
            $data = $model->where('id', $id)->delete($id);
            if($data){
                $model->delete($id);
                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'messages' => [
                        'success' => 'Role deleted successfully'
                    ]
                ];
            }else{
                $response = [
                    'status'   => 500,
                    'error'    => null,
                    'messages' => [
                        'success' => 'Something went wrong! Please try again later'
                    ]
                ];
            }
            return $this->respond($response);
        }
        public function checkAccess($id,$accessTo)
        {
            $model= new RolesModel();
            $data=$model->find($id);
            if(!isset($data["$accessTo"]))
            {
                
                $response = [
                    'status'   => 404,
                    'error'    => null,
                    'messages' => "Similar key not found",
                    'access' =>false,
                ];
            return $this->respond($response);

                
            }
            if(!$data["$accessTo"])
            {
                $response = [
                    'status'   => 403,
                    'error'    => null,
                    'messages' =>"Access is denied",
                    'access' =>false,

                ];
            }
            else if($data["$accessTo"])
            {
                $response = [
                    'status'   => 200,
                    'error'    => null,
                    'messages' =>"Access granted",
                    'access' =>true,
                ];
            return $this->respond($response);

            }
            else {
                $response = [
                    'status'   => 200,
                    'error'    => null,
                    "Messages"=>"Something went wrong! Please try again later",
                    'access' =>false,
                ];
            return $this->respond($response);

            }
            
        }
}
