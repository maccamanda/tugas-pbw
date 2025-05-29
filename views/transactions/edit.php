<?php
use App\Database\TransactionDAO;

$txDao = new TransactionDAO();
$transaction = $txDao->get($id);

if (!$transaction) {
    echo "<script>alert('Transaksi tidak ditemukan'); window.location.href='/transactions';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $created_at = $_POST['created_at'];

    $txDao->update(new \App\Models\Transaction(
        $transaction->getId(),
        $transaction->getUserId(),
        $transaction->getAmount(),
        $transaction->getTransactionType(),
        $created_at
    ));

    header("Location: /transactions");
    exit;
}
?>

<h2>Edit Transaction</h2>
<a href="/transactions">Back to List</a><br><br>

<form method="POST">
    <label>User ID:</label><br>
    <input type="text" value="<?= $transaction->getUserId() ?>" readonly><br><br>

    <label>Amount:</label><br>
    <input type="text" value="<?= number_format($transaction->getAmount()) ?>" readonly><br><br>

    <label>Transaction Type:</label><br>
    <input type="text" value="<?= ucfirst($transaction->getTransactionType()) ?>" readonly><br><br>

    <label for="created_at">Created At:</label><br>
    <input type="datetime-local" name="created_at" value="<?= date('Y-m-d\TH:i', strtotime($transaction->getCreatedAt())) ?>"><br><br>

    <button type="submit">Save</button>
</form>