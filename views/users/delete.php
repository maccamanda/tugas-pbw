<?php
    use App\Database\UserDAO;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userDao = new UserDAO();
        $user = $userDao->delete($id);
        header("Location: /users");
    }