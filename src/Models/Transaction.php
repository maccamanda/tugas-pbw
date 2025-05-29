<?php
namespace App\Models;

class Transaction
{
    private $id, $user_id, $amount, $transaction_type, $created_at;

    public function __construct($id, $user_id, $amount, $transaction_type, $created_at)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->amount = $amount;
        $this->transaction_type = $transaction_type;
        $this->created_at = $created_at;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getTransactionType(): string
    {
        return $this->transaction_type;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
    public function setAmount($amount): void {
        $this->amount = $amount;
    }
}