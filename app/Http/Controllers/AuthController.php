<?php

namespace App\Http\Controllers;

use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: /login");
            exit();
        }

        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $userModel = new User();
        $user = $userModel->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            header("Location: /profile");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: /register");
            exit();
        }

        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirmPassword = trim($_POST['confirm_password'] ?? '');

        if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
            echo "All fields are required!";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format!";
            return;
        }

        if ($password !== $confirmPassword) {
            echo "Passwords do not match!";
            return;
        }

        if (strlen($password) < 8) {
            echo "Password must be at least 8 characters!";
            return;
        }

        $userModel = new User();
        if ($userModel->exists($username, $email)) {
            echo "Username or email already exists!";
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userModel->create([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
        ]);

        echo "Registration successful! Redirecting to login.";
        header("Refresh: 2; url=/login");
    }

    public function logout()
    {
        session_start();
        session_destroy();
        echo "Logged out successfully! <a href='/login'>Login</a>";
    }
}

?>