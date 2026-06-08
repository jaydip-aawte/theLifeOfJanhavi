<?php

require_once __DIR__ . '/BaseModel.php';

class Admin extends BaseModel
{
    protected string $table = 'admins';

    public function findByUsername(string $username): ?array
    {
        return $this->findByField('username', $username);
    }

    public function verifyPassword(string $password, string $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }

    public function updatePassword(int $id, string $newPassword): bool
    {
        $hashed = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->db->prepare("UPDATE {$this->table} SET password = :password, updated_at = NOW() WHERE id = :id");
        return $stmt->execute(['password' => $hashed, 'id' => $id]);
    }

    public function getLoginAttempts(string $ip): int
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) as attempts FROM login_attempts WHERE ip_address = :ip AND attempted_at > DATE_SUB(NOW(), INTERVAL 15 MINUTE)"
        );
        $stmt->execute(['ip' => $ip]);
        return (int)$stmt->fetch()['attempts'];
    }

    public function recordLoginAttempt(string $ip, bool $success): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO login_attempts (ip_address, success, attempted_at) VALUES (:ip, :success, NOW())"
        );
        $stmt->execute(['ip' => $ip, 'success' => (int)$success]);
    }

    public function clearLoginAttempts(string $ip): void
    {
        $stmt = $this->db->prepare("DELETE FROM login_attempts WHERE ip_address = :ip");
        $stmt->execute(['ip' => $ip]);
    }
}
