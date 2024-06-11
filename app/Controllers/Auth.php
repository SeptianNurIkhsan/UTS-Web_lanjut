<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function index_login()
    {
        return view('auth/login');
    }

    public function login()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->getUserByUsername($username);

        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id'       => $data['id'],
                    'username' => $data['username'],
                    'role'     => $data['role'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Username not Found');
            return redirect()->to('/login');
        }
    }

    public function index_register()
    {
        return view('auth/register');
    }

    public function register()
    {
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $role = $this->request->getVar('role');

        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role
        ];

        if ($model->insert($data)) {
            return redirect()->to('/login');
        } else {
            return redirect()->back()->with('error', 'Failed to register user.');
        }
    }

    

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}