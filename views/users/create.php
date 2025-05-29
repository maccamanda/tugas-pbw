<?php 
    use App\Database\UserDAO;
    use App\Models\User;

    $email = '';
    $password = '';
    $name = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];

        $userDao = new UserDAO();
        $user = $userDao->create(new User(null, $email, $password, $name, null));
        header("Location: /users");
    }
?>

<h2>Create user</h2>
<a href="/users" >Back to List</a><br><br>

<form method="POST">
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?= $email ?>"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" value="<?= $password ?>"><br><br>

    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="<?= $name ?>"><br><br>

    <button type="submit">Create</button>
</form>