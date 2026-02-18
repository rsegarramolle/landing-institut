<?php

declare(strict_types=1);

use App\Database;
use App\Controllers\LandingController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\SeccionsController;
use App\Controllers\Admin\ConfigController;
use App\Controllers\Admin\OfertaController;

require_once dirname(__DIR__) . '/vendor/autoload.php';

session_start();

$config = require dirname(__DIR__) . '/config/config.php';
$db = new Database($config['db']);
$pdo = $db->getConnection();

$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH) ?: '/';
$path = rtrim($path, '/') ?: '/';

// Rutes públiques
if ($path === '/') {
    (new LandingController($pdo, $config))->index();
    return;
}

// Admin: login
if ($path === '/admin/login') {
    $ctrl = new AuthController($pdo, $config);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ctrl->login();
    } else {
        $ctrl->showLogin();
    }
    return;
}

if ($path === '/admin/logout') {
    (new AuthController($pdo, $config))->logout();
    return;
}

// Admin: panell (requereix sessió)
if (!isset($_SESSION['admin_id'])) {
    if (strpos($path, '/admin') === 0 && $path !== '/admin/login') {
        header('Location: /admin/login');
        exit;
    }
}

if ($path === '/admin') {
    header('Location: /admin/seccions');
    exit;
}

if ($path === '/admin/seccions') {
    (new SeccionsController($pdo, $config))->index();
    return;
}

if (preg_match('#^/admin/seccions/edit/(\d+)$#', $path, $m)) {
    $ctrl = new SeccionsController($pdo, $config);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ctrl->update();
    } else {
        $ctrl->edit((int) $m[1]);
    }
    return;
}

if ($path === '/admin/config') {
    $ctrl = new ConfigController($pdo, $config);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ctrl->save();
    } else {
        $ctrl->index();
    }
    return;
}

if ($path === '/admin/oferta') {
    (new OfertaController($pdo, $config))->index();
    return;
}

if ($path === '/admin/oferta/nova') {
    $ctrl = new OfertaController($pdo, $config);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ctrl->create();
    } else {
        $ctrl->form();
    }
    return;
}

if (preg_match('#^/admin/oferta/edit/(\d+)$#', $path, $m)) {
    $ctrl = new OfertaController($pdo, $config);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ctrl->update((int) $m[1]);
    } else {
        $ctrl->edit((int) $m[1]);
    }
    return;
}

if (preg_match('#^/admin/oferta/delete/(\d+)$#', $path, $m)) {
    (new OfertaController($pdo, $config))->delete((int) $m[1]);
    return;
}

// 404
http_response_code(404);
echo '<h1>404 - Pàgina no trobada</h1><p><a href="/">Tornar a l\'inici</a></p>';
