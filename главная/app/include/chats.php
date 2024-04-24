<?php
include SITE_ROOT . "/app/controllers/messages.php";

$my_name = selectOne('users', ['id' => $_SESSION['id']]);
?>

<div class="all-mess">
    <div class="mess">
        <div class="all-comments">
            <?php if($messages > 0): ?>
                <?php foreach($messages as $message): ?>
                    <?php if($my_name['username'] == $message['username']): ?>
                        <div class="one-comment one-my-comment col-8">
                            <i class="fa-solid fa-skull"></i><span><?=$message['username'];?></span>
                            <i class="fa-solid fa-clock"></i><span><?=$message['created_data'];?></span>
                            <div class="text">
                                <?=$message['message'];?>
                            </div>
                        </div>
                    <?php elseif($my_name['username'] != $message['username']): ?>
                        <div class="one-comment col-8">
                            <i class="fa-solid fa-skull"></i><span><?=$users_chat['username'];?></span>
                            <i class="fa-solid fa-clock"></i><span><?=$message['created_data'];?></span>
                            <div class="col-12 text">
                                <?=$message['message'];?>
                            </div>
                        </div>
                    <?endif;?>
                <?php endforeach; ?>
            <?endif;?>
        </div>
    </div> 
</div>