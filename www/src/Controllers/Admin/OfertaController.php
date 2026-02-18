<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use PDO;
use App\Models\OfertaEducativa;

class OfertaController
{
    public function __construct(
        private PDO $pdo,
        private array $config
    ) {}

    public function index(): void
    {
        $model = new OfertaEducativa($this->pdo);
        $oferta = $model->findAll();
        $config = $this->config;
        require dirname(__DIR__, 3) . '/views/admin/oferta.php';
    }

    public function form(): void
    {
        $config = $this->config;
        $item = null;
        require dirname(__DIR__, 3) . '/views/admin/oferta_form.php';
    }

    public function create(): void
    {
        $model = new OfertaEducativa($this->pdo);
        $model->create([
            'titol'      => trim($_POST['titol'] ?? ''),
            'descripcio' => trim($_POST['descripcio'] ?? ''),
            'enllac'     => trim($_POST['enllac'] ?? '') ?: null,
            'ordre'      => (int) ($_POST['ordre'] ?? 0),
            'actiu'      => isset($_POST['actiu']) ? 1 : 0,
        ]);
        header('Location: /admin/oferta');
        exit;
    }

    public function edit(int $id): void
    {
        $model = new OfertaEducativa($this->pdo);
        $item = $model->findById($id);
        if (!$item) {
            header('Location: /admin/oferta');
            exit;
        }
        $config = $this->config;
        require dirname(__DIR__, 3) . '/views/admin/oferta_form.php';
    }

    public function update(int $id): void
    {
        $model = new OfertaEducativa($this->pdo);
        $model->update($id, [
            'titol'      => trim($_POST['titol'] ?? ''),
            'descripcio' => trim($_POST['descripcio'] ?? ''),
            'enllac'     => trim($_POST['enllac'] ?? '') ?: null,
            'ordre'      => (int) ($_POST['ordre'] ?? 0),
            'actiu'      => isset($_POST['actiu']) ? 1 : 0,
        ]);
        header('Location: /admin/oferta');
        exit;
    }

    public function delete(int $id): void
    {
        $model = new OfertaEducativa($this->pdo);
        $model->delete($id);
        header('Location: /admin/oferta');
        exit;
    }
}
