<?php
session_start();
//CONNECTION DATABASE
require 'connection.php';

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

$request = $database->query('SELECT * FROM users');

$users = $request->fetchAll();

$usersByNickname = array();

foreach ($users as $user) {
    $usersByNickname[$user['nickname']] = $user;
}

date_default_timezone_set('Europe/Paris');

$nickname ='';
if(isset($_COOKIE['user_cookie'])){
    $nickname = $_COOKIE['user_cookie'];
}

function createMessage($msgUserId, $message, $nickname, $time) {
    include './connection.php';
    $insMsg = $database->prepare('INSERT INTO messages(user_id, message, ip_address, created_at) VALUES(?, ?, ?, ?)');
    $insMsg->execute(array($msgUserId, $message, getIp(), $time));
    setcookie('user_cookie', $nickname, time()+3600, '/');
//     echo '<pre>';
//     var_export($_COOKIE);
//     var_export($nickname);
//     echo '</pre>';exit;
}

if(isset($_POST['nickname']) && isset($_POST['message'])){
    $nickname = htmlspecialchars($_POST['nickname']);
    // var_export($nickname);
    $message = htmlspecialchars($_POST['message']);
    $time = date('Y-m-d H:i:s');
    
    
    if (isset($usersByNickname[$nickname])) {
        $msgUserId = $usersByNickname[$nickname]['id'];
        
    } else {
        $insUser = $database->prepare('INSERT INTO users(nickname, created_at, ip_address, color) VALUES(?, ?, ?, ?)');
        $insUser->execute(array($nickname, $time, getIp(), '#ff00ff'));
        $msgUserId = $database->lastInsertId();
    }
    
    // echo 'toto';exit;
    createMessage($msgUserId, $message, $nickname, $time);  
}

header('Location: /index.php');