<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class Usuari
{
    public function __construct(
        private PDO $pdo
    ) {}

    /**
     * @return array<string, mixed>|null
     */
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuaris WHERE email = ? AND actiu = 1 LIMIT 1');
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
