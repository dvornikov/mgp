<?php

require_once 'vendor/autoload.php';
require_once 'config.php';

// Настраиваем Twig.
$loader = new Twig_Loader_Filesystem('themes/default/templates');
$twig = new Twig_Environment($loader, array());

// Настраиваем ORM.
ORM::configure(array(
    'connection_string' => 'mysql:host='.DATABASE_HOST.';dbname='.DATABASE_NAME,
    'username' => DATABASE_USERNAME,
    'password' => DATABASE_PASSWORD
));

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ( !isset($_SESSION['user_id']) ) {
    $action = 'login';
}
else {
    $user = ORM::for_table('users')->where('id', $_SESSION['user_id'])->find_one();
    $twig->addGlobal('user', $user);

    $users = ORM::for_table('users')->where_not_equal(array('id' => $user->id))->find_many();
    $twig->addGlobal('users', $users);
}

switch ($action) {
    case 'login':
        include 'login.php';
        break;

    case 'account':
        include 'account.php';
        break;

    case 'user':
        include 'user.php';
        break;

    case 'chat':
        include 'chat.php';
        break;

    case 'logout':
        unset($_SESSION['user_id']);
        header('Location: /index.php?action=login');
        break;

    default:
        include '404.php';
        break;
}
?>
