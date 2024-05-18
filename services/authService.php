<?php
require_once 'userService.php';

class AuthService
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }


    public function validateUser($userEmail, $password): bool
    {
        $user = $this->userService->getUserByEmail($userEmail)->fetch_assoc();
        return password_verify($password, $user['password']);
    }

    public function destroySession()
    {
        $_SESSION = array();

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 86400, '/');
        }

        session_destroy();
        $this->redirectToLogin();
    }

    public function redirectToLogin()
    {
        header('Location: ../start/login.php');
        exit();
    }

    public function checkUserType()
    {
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== $this->userType) {
            $this->redirectToLogin();
        }
    }

    public function setUserType($userType)
    {
        $_SESSION['user_type'] = $userType;
    }

    public function getUserType()
    {
        return isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;
    }
}

?>