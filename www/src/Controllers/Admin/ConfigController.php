<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use PDO;
use App\Models\Config;

class ConfigController
{
    public function __construct(
        private PDO $pdo,
        private array $config
    ) {}

    public function index(): void
    {
        $model = new Config($this->pdo);
        $configValues = $model->getAll();
        $config = $this->config;
        require dirname(__DIR__, 3) . '/views/admin/config.php';
    }

    public function save(): void
    {
        $model = new Config($this->pdo);
        $keys = [
            'nom_centre', 'adreca', 'cp_ciutat', 'telefon', 'email',
            'facebook', 'twitter', 'instagram', 'linkedin',
        ];
        foreach ($keys as $key) {
            if (isset($_POST[$key])) {
                $model->set($key, trim((string) $_POST[$key]));
            }
        }
        header('Location: /admin/config?ok=1');
        exit;
    }
}
