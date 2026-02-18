<?php

declare(strict_types=1);

namespace App\Controllers;

use PDO;
use App\Models\Seccio;
use App\Models\Config;
use App\Models\OfertaEducativa;

class LandingController
{
    public function __construct(
        private PDO $pdo,
        private array $config
    ) {}

    public function index(): void
    {
        $seccioModel = new Seccio($this->pdo);
        $configModel = new Config($this->pdo);
        $ofertaModel = new OfertaEducativa($this->pdo);

        $seccions = $seccioModel->findAllActives();
        $config = $configModel->getAll();
        $oferta = $ofertaModel->findAllActives();

        $hero = null;
        foreach ($seccions as $s) {
            if ($s['clau'] === 'hero') {
                $hero = $s;
                break;
            }
        }

        $this->render('landing', [
            'seccions' => $seccions,
            'hero'     => $hero,
            'config'   => $config,
            'oferta'   => $oferta,
        ]);
    }

    /**
     * @param array<string, mixed> $data
     */
    private function render(string $view, array $data = []): void
    {
        extract($data);
        $config = $this->config;
        require dirname(__DIR__, 2) . '/views/landing/' . $view . '.php';
    }
}
