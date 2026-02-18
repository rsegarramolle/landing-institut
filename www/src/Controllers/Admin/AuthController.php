<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use PDO;
use App\Models\Usuari;

class AuthController
{
    public function __construct(
        private PDO $pdo,
        private array $config
    ) {}

    public function showLogin(): void
    {
        $error = $_SESSION['login_error'] ?? null;
        unset($_SESSION['login_error']);
        require dirname(__DIR__, 3) . '/views/admin/login.php';
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            $_SESSION['login_error'] = 'Introduïu email i contrasenya.';
            header('Location: /admin/login');
            exit;
        }

        $usuariModel = new Usuari($this->pdo);
        $user = $usuariModel->findByEmail($email);

        if (!$user || !$usuariModel->verifyPassword($password, $user['password'])) {
            $_SESSION['login_error'] = 'Credencials incorrectes.';
            header('Location: /admin/login');
            exit;
        }

        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_email'] = $user['email'];
        header('Location: /admin');
        exit;
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        header('Location: /admin/login');
        exit;
    }
}
