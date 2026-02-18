<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class OfertaEducativa
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
            'SELECT * FROM oferta_educativa WHERE actiu = 1 ORDER BY ordre ASC, id ASC'
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM oferta_educativa ORDER BY ordre ASC, id ASC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM oferta_educativa WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO oferta_educativa (titol, descripcio, imatge, enllac, ordre, actiu) VALUES (?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $data['titol'] ?? '',
            $data['descripcio'] ?? '',
            $data['imatge'] ?? null,
            $data['enllac'] ?? null,
            (int) ($data['ordre'] ?? 0),
            isset($data['actiu']) ? (int) $data['actiu'] : 1,
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $allowed = ['titol', 'descripcio', 'imatge', 'enllac', 'ordre', 'actiu'];
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
        $stmt = $this->pdo->prepare('UPDATE oferta_educativa SET ' . implode(', ', $set) . ' WHERE id = ?');
        return $stmt->execute($params);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM oferta_educativa WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
