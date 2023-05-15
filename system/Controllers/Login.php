<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use \Firebase\JWT\JWT;

class login extends ResourceController
{
  use ResponseTrait;
  // all users
  public function index($email = null, $password = null)
  {
    $model = new UserModel();
    $password = $this->request->getVar('password');
    $param = [
      'user_name' => $this->request->getVar('user_name')
    ];

    $data = $model->where($param)->first();
   
    if(!$data)
    {
      return $this->failNotFound('User not  found');

    }
  $passVerify = password_verify($password,$data['password']);

    if ($passVerify) {
      return $this->respond($data);
    } else {
      return $this->failNotFound('Password incorrect');
    }
  }

 
}
