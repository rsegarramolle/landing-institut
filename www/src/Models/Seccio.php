<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class Seccio
{
    public function __construct(
        private PDO $pdo
    ) {}

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findAllActives(): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM seccions WHERE actiu = 1 ORDER BY ordre ASC, id ASC'
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findByClau(string $clau): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM seccions WHERE clau = ? AND actiu = 1 LIMIT 1');
        $stmt->execute([$clau]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM seccions ORDER BY ordre ASC, id ASC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(int $id, array $data): bool
    {
        $allowed = ['titol', 'subtitol', 'cos', 'imatge', 'ordre', 'actiu'];
        $set = [];
        $params = [];
        foreach ($allowed as $key) {
            if (array_key_exists($key, $data)) {
                $set[] = "`$key` = ?";
                $params[] = $data[$key];
            }
        }
        if (empty($set)) {
            return false;
        }
        $params[] = $id;
        $sql = 'UPDATE seccions SET ' . implode(', ', $set) . ' WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
