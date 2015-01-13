<?php
// Аутентицикация и авторизация

$error = '';

if ( !empty($_POST)) {
    if (test_post_request()) {
        $user = ORM::for_table('users')->where('login', $_POST['login'])->find_one();

        if ( !$user || $user->password !== md5($_POST['password'])) {
            $error = 'Oops. Неверный логин или пароль.';
        }
        else {
            $_SESSION['user_id'] = $user->id;
            header('Location: /index.php?action=account');
            die();
        }
    }
    else {
        $error = 'Oops. Заполните все поля.';
    }
}

function test_post_request()
{
    $valid = FALSE;
    if ( !empty($_POST['login']) && !empty($_POST['password'])) {
        $valid = TRUE;
    }

    return $valid;
}

echo $twig->render('login.html.twig', array('error' => $error));
?>
