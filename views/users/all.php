<?php 
    use App\Database\UserDAO;

    $userDao = new UserDAO();
    $users = $userDao->all();
?>

<h2>User List</h2>
<a href="/transactions">Lihat transaction list</a>
<p>
<a href="/users/create">Create New User</a>
<table style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
        <tr>
        <td><?= $user->getId() ?></td>
            <td><?= $user->getName() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getCreatedAt() ?></td>
            <td><a href="/users/<?= $user->getId() ?>">Lihat</a></td>
            <td><a href="/users/<?= $user->getId() ?>/edit">Ubah</a></a></td>
            <td><form action="/users/<?= $user->getId() ?>/delete" method="POST">
    <button type="submit" style="background:none; border:none; color:blue; text-decoration:underline; cursor:pointer; font:inherit; padding:0;">
        Hapus
    </button>
</form></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
