<?php
require_once 'models/User.php';
require_once 'koneksi/database.php';

class AuthController {
    private $user;

    public function __construct()
    {
        global $pdo;
        $this->user = new User($pdo);
    }

    public function showLogin() 
    {
        include 'views/auth/login.php';
    }

    public function showRegister() 
    {
        include 'views/auth/register.php';
    }

    public function login() {
        $identifier = $_POST['identifier'];
        $password = $_POST['password'];

        $user = $this->user->login($identifier, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            if ($user['role'] === 'admin') {
                header('Location: /admin');
            } else {
                header('Location: /');
            }
        } else {
            echo 'Login failed!';
        }
    }

    public function register() {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = isset($_POST['role']) ? $_POST['role'] : 'user';

        $this->user->register($username, $email, $password, $role);
        header('Location: /login');
    }

    public function logout() {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /');
    }
}
