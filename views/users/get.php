<?php 
    use App\Database\UserDAO;

    $userDao = new UserDAO();
    $user = $userDao->get($id);
?>

<h2>User Detail</h2>
<a href="/users" >Back to List</a>
<table>
    <tr>
        <th>ID</th>
        <td><?= $user->getId() ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?= $user->getName() ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?= $user->getEmail() ?></td>
    </tr>
    <tr>
        <th>Created At</th>
        <td><?= $user->getCreatedAt() ?></td>
    </tr>
    <tr>
        <th>Balance</th>
        <td><?= number_format($user->getBalance()) ?></td>
</tr>
</table>