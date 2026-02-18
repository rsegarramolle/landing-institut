<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use PDO;
use App\Models\Seccio;

class SeccionsController
{
    public function __construct(
        private PDO $pdo,
        private array $config
    ) {}

    public function index(): void
    {
        $model = new Seccio($this->pdo);
        $seccions = $model->findAll();
        $config = $this->config;
        require dirname(__DIR__, 3) . '/views/admin/seccions.php';
    }

    public function edit(int $id): void
    {
        $model = new Seccio($this->pdo);
        $stmt = $this->pdo->prepare('SELECT * FROM seccions WHERE id = ?');
        $stmt->execute([$id]);
        $seccio = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$seccio) {
            header('Location: /admin/seccions');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->update();
            return;
        }
        $config = $this->config;
        require dirname(__DIR__, 3) . '/views/admin/seccio_edit.php';
    }

    public function update(): void
    {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id <= 0) {
            header('Location: /admin/seccions');
            exit;
        }
        $model = new Seccio($this->pdo);
        $model->update($id, [
            'titol'   => trim($_POST['titol'] ?? ''),
            'subtitol'=> trim($_POST['subtitol'] ?? ''),
            'cos'     => trim($_POST['cos'] ?? ''),
            'ordre'   => (int) ($_POST['ordre'] ?? 0),
            'actiu'   => isset($_POST['actiu']) ? 1 : 0,
        ]);
        header('Location: /admin/seccions');
        exit;
    }
}
