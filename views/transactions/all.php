<?php
use App\Database\TransactionDAO;

$txDao = new TransactionDAO();
$transactions = $txDao->allWithUsers();
?>

<h2>Transaction List</h2>
<a href="/users">Lihat user list</a><br><br>
<P>
<a href="/transactions/create">Create New Transaction</a><br><br>

<table style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $tx): ?>
        <tr>
            <td><?= $tx['id'] ?></td>
            <td><?= htmlspecialchars($tx['user_name']) ?></td>
            <td><?= number_format($tx['amount']) ?></td>
            <td><?= ucfirst($tx['transaction_type']) ?></td>
            <td><?= $tx['created_at'] ?></td>
            <td><a href="/transactions/<?= $tx['id'] ?>">Lihat</a></td>
            <td><a href="/transactions/<?= $tx['id'] ?>/edit">Ubah</a></td>
            <td>
                <form action="/transactions/<?= $tx['id'] ?>/delete" method="POST">
                    <button type="submit" style="background:none; border:none; color:blue; text-decoration:underline; cursor:pointer; font:inherit; padding:0;">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>