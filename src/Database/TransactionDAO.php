<?php
namespace App\Database;

use App\Models\Transaction;

class TransactionDAO extends Connection {

    public function allWithUsers(): array {
        $sql = "SELECT t.*, u.name AS user_name 
                FROM transactions t
                JOIN users u ON t.user_id = u.id";
        $data = self::query($sql);
        $transactions = [];
    
        foreach ($data as $row) {
            $transactions[] = [
                'id' => $row['id'],
                'user_name' => $row['user_name'],
                'amount' => $row['amount'],
                'transaction_type' => $row['transaction_type'],
                'created_at' => $row['created_at']
            ];
        }
    
        return $transactions;
    }

    public function create(Transaction $transaction) {
        $amount = $transaction->getAmount();
        $userId = $transaction->getUserId();
        $type = $transaction->getTransactionType();
        $createdAt = date("Y-m-d H:i:s");

        $currentBalance = self::query("SELECT balance FROM users WHERE id = ?", [$userId])[0]['balance'];
    
        if ($type === 'deposit') {
            $newBalance = $currentBalance + $amount;
        } elseif ($type === 'withdrawal') {
            $newBalance = $currentBalance - $amount;
        } else {
            throw new \Exception("Unknown transaction type: $type");
        }
    
        self::query("UPDATE users SET balance = ? WHERE id = ?", [$newBalance, $userId]);
    
        $sql = "INSERT INTO transactions (user_id, amount, transaction_type, created_at) VALUES (?, ?, ?, ?)";
        $params = [$userId, $amount, $type, $createdAt];
        return self::query($sql, $params);
    }
    public function get(int $id): ?Transaction {
        $sql = "SELECT * FROM transactions WHERE id = ?";
        $params = [$id];
        $data = self::query($sql, $params);
    
        if (count($data) > 0) {
            return new Transaction(
                $data[0]['id'],
                $data[0]['user_id'],
                $data[0]['amount'],
                $data[0]['transaction_type'],
                $data[0]['created_at']
            );
        }
    
        return null;
    }
}