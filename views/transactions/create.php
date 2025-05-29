<?php
use App\Database\UserDAO;
use App\Database\TransactionDAO;
use App\Models\Transaction;

$userDao = new UserDAO();
$users = $userDao->all();

$user_id = '';
$transaction_type = '';
$amount = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $transaction_type = $_POST['transaction_type'];
    $amount = $_POST['amount'];

    $transactionDao = new TransactionDAO();
    $transactionDao->create(new Transaction(null, $user_id, $amount, $transaction_type, null));
    header("Location: /transactions");
}
?>

<h2>Create Transaction</h2>
<a href="/transactions">Back to List</a><br><br>

<form method="POST">
    <label for="user_id">User ID:</label><br>
    <select name="user_id" id="user_id" required>
        <option value="">-- Pilih User --</option>
        <?php foreach ($users as $user): ?>
            <option value="<?= $user->getId() ?>" <?= $user_id == $user->getId() ? 'selected' : '' ?>>
                <?= $user->getName() ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="transaction_type">Transaction Type:</label><br>
    <select name="transaction_type" id="transaction_type" required>
        <option value="">-- Pilih Tipe --</option>
        <option value="deposit" <?= $transaction_type == 'deposit' ? 'selected' : '' ?>>Deposit</option>
        <option value="withdrawal" <?= $transaction_type == 'withdrawal' ? 'selected' : '' ?>>Withdrawal</option>
    </select><br><br>

    <label for="amount">Amount:</label><br>
    <input type="number" name="amount" id="amount" value="<?= $amount ?>" required><br><br>

    <button type="submit">Create</button>
</form>
