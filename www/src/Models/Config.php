<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class Config
{
    /** @var array<string, string>|null */
    private ?array $cache = null;

    public function __construct(
        private PDO $pdo
    ) {}

    public function get(string $clau): ?string
    {
        $this->loadAll();
        return $this->cache[$clau] ?? null;
    }

    /**
     * @return array<string, string>
     */
    public function getAll(): array
    {
        $this->loadAll();
        return $this->cache ?? [];
    }

    public function set(string $clau, string $valor): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO config (clau, valor) VALUES (?, ?) ON DUPLICATE KEY UPDATE valor = VALUES(valor)'
        );
        $result = $stmt->execute([$clau, $valor]);
        $this->cache = null;
        return $result;
    }

    private function loadAll(): void
    {
        if ($this->cache !== null) {
            return;
        }
        $stmt = $this->pdo->query('SELECT clau, valor FROM config');
        $this->cache = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->cache[$row['clau']] = (string) $row['valor'];
        }
    }
}
