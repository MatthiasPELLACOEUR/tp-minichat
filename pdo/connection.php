<?php

try {
    $database = new PDO('mysql:host=127.0.0.1;dbname=minichat;charset=utf8',
                    'root',
                    '',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

?>
