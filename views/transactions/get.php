<?php
use App\Database\TransactionDAO;

$transactionDao = new TransactionDAO();
$transaction = $transactionDao->get($id);

if (!$transaction) {
    echo "<h2>Transaksi tidak ditemukan</h2>";
    echo "<a href='/transactions'>Back to List</a>";
    exit;
}
?>
<h2>Transaction Detail</h2>
<a href="/transactions">Back to List</a>
<table>
    <tr>
        <th>ID</th>
        <td><?= $transaction->getId() ?></td>
    </tr>
    <tr>
        <th>User ID</th>
        <td><?= $transaction->getUserId() ?></td>
    </tr>
    <tr>
        <th>Amount</th>
        <td><?= number_format($transaction->getAmount()) ?></td>
    </tr>
    <tr>
        <th>Type</th>
        <td><?= ucfirst($transaction->getTransactionType()) ?></td>
    </tr>
    <tr>
        <th>Created At</th>
        <td><?= $transaction->getCreatedAt() ?></td>
    </tr>
</table>