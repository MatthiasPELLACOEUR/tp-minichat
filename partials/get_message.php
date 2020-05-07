<?php

//CONNECTION DATABASE
require '../pdo/connection.php';

$allMessageStatement = $database->query('SELECT messages.*, users.nickname FROM messages INNER JOIN users WHERE users.id = messages.user_id ORDER BY messages.created_at');
$allMessages = $allMessageStatement->fetchAll(PDO::FETCH_ASSOC);

foreach ($allMessages as $message) : ?>
    <div class="card message message-content">
        <div class="card-body">
            <p class="my-0">
                <strong">
                    <?= $message['nickname'] ?>
                </strong>
                :
                <span class="created_at"><?= $message['message'] ?></span>
                <span class="float-right"><?= $message['created_at'] ?></span>
            </p>
        </div>
    </div>
<?php endforeach; ?>