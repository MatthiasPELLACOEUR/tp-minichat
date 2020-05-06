<?php

//CONNECTION DATABASE
include 'connection.php';

$request = $database->query('SELECT * FROM users');

$users = $request->fetchAll();

$usersByNickname = array();

foreach ($users as $user) {
    $usersByNickname[$user['nickname']] = $user;
}


date_default_timezone_set('Europe/Paris');

$nickname = htmlspecialchars($_POST['nickname']);
$message = htmlspecialchars($_POST['message']);
$time = date('Y-m-d H:i:s');

function getIp(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


function createMessage($msgUserId, $message, $time)
{
    include './connection.php';
    $insMsg = $database->prepare('INSERT INTO messages(user_id, message, ip_address, created_at) VALUES(?, ?, ?, ?)');
    $insMsg->execute(array($msgUserId, $message, getIp(), $time));
}


if (isset($usersByNickname[$nickname])) {
    $msgUserId = $usersByNickname[$nickname]['id'];
} else {
    $insUser = $database->prepare('INSERT INTO users(nickname, created_at, ip_address) VALUES(?, ?, ?)');
    $insUser->execute(array($nickname, $time, getIp()));
    $msgUserId = $database->lastInsertId();
}

createMessage($msgUserId, $message, $time);


header('Location: /index.php');
