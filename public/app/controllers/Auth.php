<?php

use App\Core\Controller;

class Auth extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function login()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = $_POST['input'];
            $password = $_POST['password'];
            $userModel = $this->model('User');
            $user = $userModel->login($input, $password);

            if ($user) {                
                if ($user['role'] === 'admin') {
                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['admin_role'] = $user['role'];
                    $_SESSION['username'] = $user['username'];
                    header('Location: ' . MAIN_URL . 'admin/dashboard');
                } else {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user_role'] = $user['role'];
                    header('Location: ' . MAIN_URL . 'home/index');
                }

            } else if (empty($input) && empty($password)) {
                $data['title'] = 'Login - SIPPEKA';
                $this->view('layout/auth_header', $data);
                $this->view('auth/login', ['error' => 'Masukkan username atau email dan password']);
                $this->view('layout/auth_footer');
            } else {
                $data['title'] = 'Login - SIPPEKA';
                $this->view('layout/auth_header', $data);
                $this->view('auth/login', ['error' => 'Username, email atau password salah atau belum terdaftar']);
                $this->view('layout/auth_footer');
            }
        } else {
            $data['title'] = 'Login - SIPPEKA';
            $this->view('layout/auth_header', $data);
            $this->view('auth/login');
            $this->view('layout/auth_footer');
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if (empty($username) || empty($password)) {
                $data['title'] = 'Register - SIPPEKA';
                $this->view('layout/auth_header', $data);
                $this->view('auth/register', ['error' => 'Masukkan Username dan Password!']);
                $this->view('layout/auth_footer');
                return;
            } else if ($password !== $confirm_password) {
                $data['title'] = 'Register - SIPPEKA';
                $this->view('layout/auth_header', $data);
                $this->view('auth/register', ['error' => 'Password tidak sama!']);
                $this->view('layout/auth_footer');
            } else {
                $userModel = $this->model('User');
    
                if ($userModel->register([
                    'nama' => $nama,
                    'username' => $username,
                    'email' => $email,
                    'password' => $password
                ])) {
                    $data['title'] = 'Register - SIPPEKA';
                    $this->view('layout/auth_header', $data);
                    $this->view('auth/register', ['error' => 'Gagal mendaftar']);
                    $this->view('layout/auth_footer');
                } else {
                    header('Location: ' . MAIN_URL . 'auth/login');
                    exit;
                }
            }
        } else {
            $data['title'] = 'Register - SIPPEKA';
            $this->view('layout/auth_header', $data);
            $this->view('auth/register');
            $this->view('layout/auth_footer');
        }
    }

    public function logout()
    {
        session_start();
        if (isset($_SESSION['admin_id'])) {
            unset($_SESSION['admin_id']);
            unset($_SESSION['username']);
            unset($_SESSION['admin_role']);
        } else if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['user_role']);
        }
        header('Location: ' . MAIN_URL . 'auth/login');
        exit;
    }
}