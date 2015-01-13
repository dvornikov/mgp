<?php

if ( !empty($_POST)  && $_POST['message']) {
    $message = ORM::for_table('messages')->create();

    $message->sender_id = $user->id;
    $message->receiver_id = $_GET['user'];
    $message->date = date('Y-m-d G:i:s');
    $message->text = $_POST['message'];
    $message->save();
}

$messages = ORM::for_table('messages')
    ->select('messages.*')
    ->select('users.name', 'sender')
    ->join('users', 'messages.sender_id = users.id')
    ->where_any_is(array(
        array('receiver_id' => $user->id, 'sender_id' => $_GET['user']),
        array('receiver_id' => $_GET['user'], 'sender_id' => $user->id)
    ))
    ->order_by_desc('messages.date')
    ->find_many();

echo $twig->render('chat.html.twig', array('messages' => $messages));
?>
