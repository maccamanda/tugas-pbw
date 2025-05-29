<?php
namespace App\Database;

use App\Models\User;

class UserDAO extends Connection {
    public function all(): array {
        $sql = "SELECT * FROM users";
        $data = self::query($sql);
        $users = [];
        foreach ($data as $row) {
            $users[] = new User($row['id'], $row['email'], $row['password'], $row['name'], $row['created_at'], $row['balance']);    
        }
        return $users;
    }
    public function get(int $id): ?User {
        $sql = "SELECT * FROM users WHERE id = ?";
        $params = [$id];
        $data = self::query($sql, $params);
    
        if (count($data) > 0) {
            $row = $data[0];
            return new User($row['id'], $row['email'], $row['password'], $row['name'], $row['created_at'], $row['balance']);
        }
        return null;
    }
     public function create(User $user) {
        $sql = "INSERT INTO users (email, password, name, created_at) VALUES (?, ?, ?, ?)";
        $params = [$user->getEmail(), $user->getPassword(), $user->getName(), date("Y-m-d H:i:s")];
        return self::query($sql, $params);
    }
    public function update(User $user) {
        $sql = "UPDATE users SET email = ?, password = ?, name = ? WHERE id = ?";
        $params = [$user->getEmail(), $user->getPassword(), $user->getName(), $user->getId()];
        return self::query($sql, $params);
    }
    public function delete(int $id) {
        $check = self::query("SELECT COUNT(*) as total FROM transactions WHERE user_id = ?", [$id]);
        $total = $check[0]['total'] ?? 0;
    
        if ($total > 0) {
            echo "<script>alert('Gagal menghapus: User masih memiliki transaksi.'); window.location.href = '/users';</script>";
            exit;
        }

        $sql = "DELETE FROM users WHERE id = ?";
        $params = [$id];
    
        return self::query($sql, $params);
    }
}