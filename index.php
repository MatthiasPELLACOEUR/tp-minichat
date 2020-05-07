<?php

//CONNECTION DATABASE
include 'pdo/connection.php';


$allMessageStatement = $database->query('SELECT messages.*, users.nickname FROM messages INNER JOIN users WHERE users.id = messages.user_id ORDER BY messages.created_at');
$allMessages = $allMessageStatement->fetchAll(PDO::FETCH_ASSOC);

$allUsersStatement = $database->query('SELECT * FROM users');
$allUsers = $allUsersStatement->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Mini-Chat</title>
</head>

<body>
    <nav class="navbar fixed-top navbar-dark justify-content-center">
        <a href="index.php" class="navbar-brand title"> 🐱‍👤 Welcome to the ninja-chat!</a>
    </nav>
    <aside class="list-users float-right">
        <ul>
            <?php foreach ($allUsers as $user) : ?>
                <li>
                    <p>🐱‍👤<?= $user['nickname'] ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>
    <main>
        <div class="container col-lg-8" id="container">
            <section class="row mb-5 my-5 chat">
                <div class="col-lg-12" id="messages">
                    <div class="col-lg-12" id="messages-container">
                        <?php foreach ($allMessages as $message) : ?>
                            <div class="card message message-content">
                                <div class="card-body">
                                    <p class="my-0">
                                        <strong>
                                            <?= $message['nickname'] ?>
                                        </strong>
                                        :
                                        <span class="created_at"><?= $message['message'] ?></span>
                                        <span class="float-right"><?= $message['created_at'] ?></span>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>
    </main>
    
    <div id="talkBar" class="fixed-bottom col-lg-8">
        <form action="pdo/send-message.php" method="post">
            <div class="input-group">
                <input type="text" name="nickname" id="nickname" class="form-control input-group-addon col-2" placeholder="Nickname" min-length="2" required>
                <textarea type="text" name="message" id="message" rows="1" cols="90" placeholder="Type your message here" minlength="1" required></textarea>
                <button type="submit" id="button" class="btn btn-primary col-1">Send !</button>
            </div>
        </form>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>