<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function showProfile()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        return view('profile');
    }

    public function updateProfile()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $userModel = new User();
        $id = $_SESSION['user_id'];

        if (isset($_POST['update_username'])) {
            $username = $_POST['username'];
            $userModel->update($id, ['username' => $username]);
            $_SESSION['username'] = $username;
            echo "Username updated successfully!";
        }

        if (isset($_POST['update_email'])) {
            $email = $_POST['email'];
            $userModel->update($id, ['email' => $email]);
            $_SESSION['email'] = $email;
            echo "Email updated successfully!";
        }

        if (isset($_POST['update_password'])) {
            $oldPassword = $_POST['password_old'];
            $newPassword = $_POST['password_new'];

            $user = $userModel->findById($id);
            if (password_verify($oldPassword, $user['password'])) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $userModel->update($id, ['password' => $hashedPassword]);
                echo "Password updated successfully!";
            } else {
                echo "Old password is incorrect!";
            }
        }

        if (isset($_POST['delete'])) {
            header("Location: /delete");
        }

        if (isset($_POST['logout'])) {
            header("Location: /logout");
        }
    }

    public function deleteAccount()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $userModel = new User();
        $id = $_SESSION['user_id'];

        if ($userModel->delete($id)) {
            session_destroy();
            echo "Account deleted successfully! <a href='/register'>Register</a>";
        } else {
            echo "Failed to delete account.";
        }
    }
}

?>