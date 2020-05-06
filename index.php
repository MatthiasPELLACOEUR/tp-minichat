<?php

//CONNECTION DATABASE
include 'pdo/connection.php';

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
    <nav class="navbar fixed-top navbar-dark bg-primary">
        <a href="index.php" class="navbar-brand title"> Bienvenue dans le mini-chat !</a>
    </nav>

    <main>
        <div class="container lg-5">
            <section class="row mb-5 my-5">
                <div class="col-12" id="messages">
                    Listes des messages sera ici
                </div>
            </section>
        </div>
    </main>

    <div id="talkBar" class="bg-primary fixed-bottom">
        <form action="pdo/send-message.php" method="post">
            <div class="input-group">
                <input type="text" 
                       name="nickname" 
                       id="pseudo"
                       class="form-control input-group-addon col-2"
                       placeholder="Pseudo"
                       min-length="2"
                       required
                       >
                <input type="text" 
                       name="message" 
                       id="message"
                       class="form-control col-8"
                       placeholder="Tape ton message ici"
                       minlength="1"
                       maxlength="255"
                       required
                       >
                <button type="submit" class="btn btn-success col-2">Envoyer !</button>
            </div>
        </form>
    </div>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>