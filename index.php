<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';

$router = new AltoRouter();

//Route list
$router->map('GET', '/', function () {
$query = App\Database\Connection::query("SELECT * FROM users");
//Looping to print name list
foreach ($query as $data) {
echo $data['name']." ";
}
});

$router->map('GET', '/users', function () {
	require __DIR__ . '/views/users/all.php';
});

$router->map('GET', '/users/[i:id]', function ($id) {
	require __DIR__ . '/views/users/get.php';
});

$router->map('POST', '/users/[i:id]/delete', function ($id) {
	require __DIR__ . '/views/users/delete.php';
});

$router->map('GET|POST', '/users/create', function () {
	require __DIR__ . '/views/users/create.php';
});

$router->map('GET|POST', '/users/[i:id]/edit', function ($id) {
	require __DIR__ . '/views/users/edit.php';
});

$router->map('GET|POST', '/transactions/create', function () {
    require __DIR__ . '/views/transactions/create.php';
});

$router->map('GET', '/transactions', function () {
    require __DIR__ . '/views/transactions/all.php';
});

$router->map('GET', '/transactions/[i:id]', function ($id) {
    $GLOBALS['id'] = $id;
    require __DIR__ . '/views/transactions/get.php';
});

$router->map('GET|POST', '/transactions/[i:id]/edit', function ($id) {
    $GLOBALS['id'] = $id;
    require __DIR__ . '/views/transactions/edit.php';
});

$router->map('POST', '/transactions/[i:id]/delete', function ($id) {
    $GLOBALS['id'] = $id;
    require __DIR__ . '/views/transactions/delete.php';
});

// End of Route List

// Handle jika request sesuai dengan route yang ditentukan
$match = $router->match();

// Eksekusi closure jika route ditemukan
if( is_array($match) && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    // Jika route tidak ditemukan
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "404 - Not Found";
}