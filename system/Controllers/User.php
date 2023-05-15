<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class User extends ResourceController
{
    use ResponseTrait;

    // all users
    public function index()
    {
        $model = new UserModel();
        $data['user'] = $model->orderBy('id', 'DESC')->findAll();

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
        $model = new UserModel();
        $data = $model->Where(['id' => $id])->first();
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
        $password = $this->request->getVar('password');

        $data = [
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'middle_name' => $this->request->getVar('middle_name'),
            'user_name' => $this->request->getVar('user_name'),
            'state' => $this->request->getVar('state'),
            'district' => $this->request->getVar('district'),
            'village' => $this->request->getVar('village'),
            'role' => 6,
            'gender' => $this->request->getVar('gender'),
        ];
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        $data['is_email_verified'] = true;
        $data['is_anabled'] = true;
        $id = $model->insert($data);
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

    public function getRoleId($id)
    {
        $model = new UserModel();
        $data = $model->find($id);
        if ($data == null) {
            $response = [
                "status" => 204,
                "data" => "No records found",
                'error'    => null,
            ];
        } else {

            $response = [
                "status" => 200,
                "data" => [
                    "role_id" => $data['role'],
                ],
                'error'    => null,
            ];
        }
        return $this->respond($response);
    }
    public function register($data)
    {
        $model = new UserModel();
        $data->password=password_hash($data->password,PASSWORD_DEFAULT);
        $id = $model->insert($data);
        if ($model->errors()) {
            $response = [
                "status" => 504,
                "data" => null,
                "error" => $model->errors(),
            ];
            return $response;
        }
        $response=[
            "status"=>200,
            "user_id"=>$id,
        ];
        return $response;
    }
}
