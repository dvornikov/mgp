<?php

$chats = ORM::for_table('messages')
    ->distinct()
    ->select('messages.*')
    ->select('u1.name', 'receiver')
    ->select('u2.name', 'sender')
    ->where_raw(
        '`messages`.`id` = (SELECT MAX(`m2`.`id`) FROM `messages` `m2` WHERE ((`messages`.`sender_id` = `m2`.`sender_id` AND `messages`.`receiver_id` = `m2`.`receiver_id`) OR (`messages`.`sender_id` = `m2`.`receiver_id` AND `messages`.`receiver_id` = `m2`.`sender_id`)) AND (`m2`.`receiver_id` = ? OR `m2`.`sender_id` = ?))',
        array($user->id, $user->id)
    )
    ->join('users', 'messages.receiver_id = u1.id', 'u1')
    ->join('users', 'messages.sender_id = u2.id', 'u2')
    ->order_by_desc('date')
    ->find_many();

echo $twig->render('account.html.twig', array('chats' => $chats));
?>
