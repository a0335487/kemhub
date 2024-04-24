<?php
include "path.php";
include "app/controllers/users.php";

if (!$_SESSION){
    header('location: ' . BASE_URL . 'login.php');
}

$users_chat = selectOne('users', ['id' => $_GET['user']]);
$user_no_empty_chat = selectMessageNoEmpty('users', 'messages', $_SESSION['id']);
$user_all = selectAll('users');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KEMHUB</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9bf36b73bc.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<?include("app/include/header.php");?>
<div class="container">
    <div class="content row">
        <div class="sidebar-mess col-3">
            <div class="section search">
                    <form action="search.php" method="post">
                        <input type="hidden" name="" value="">
                        <input type="text" name="search-term" class="text-input" placeholder="Search...">
                    </form>
            </div>
            <div class="section topics">
                <h3>Чаты</h3>
                <ul>
                   
                        <?foreach ($user_all as $key => $user3): ?>
                        <li>
                            <?$last_mess = lastMessage('messages', $_SESSION['id'], $user3['id']);
                            $message = $last_mess['message'];?>
                            <?if ($message != null): ?>
                                <a class="user_chat" href="<?=BASE_URL . 'chat.php?user=' . $user3['id']?>"><?=$user3['username'];?>
                                    <?php if(strlen($last_mess['message']) > 30):
                                        $message = mb_substr($message, 0, 22, 'UTF-8') . '...' . "\t";
                                    endif;?> 
                                    <?date_default_timezone_set('Asia/Krasnoyarsk');
                                    // $start_date = new DateTime($last_mess['created_data'], new DateTimeZone('UTC'));
                                    // $since_start = $start_date->diff(new DateTime(date("Y-m-d H:i:s"), new DateTimeZone('UTC')));
                                    //date('H:i', strtotime($last_mess['created_data']))?>
                                    <p><?=$message . "\t" . "\t" . '·' . "\t" . date('d-M-Y H:i', strtotime($last_mess['created_data']))?></p>
                                </a>
                           <?endif;?>
                        </li>
                        <?endforeach;?>
                   
              

                </ul>
            </div>

        </div>
        <div class="main-content-chat col-9">
            <div class="user-name col-12">
                <h5><?=$users_chat['username'];?></h5>
            </div>
            <?include "app/include/chats.php";?>
            <div class="add-mess col-12">
                <div class="send-mess col-10">
                    <form action="<?=BASE_URL . "chat.php?user=$page"?>" method="post" class="row">
                        <input type="hidden" name="page" value="<?=$page?>">
                            <div class="col-10">
                                <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder=" Сообщение..."></textarea>
                            </div>
                            <div class="col-2">
                                <button type="submit" name="goMessage" class="btn btn-save">Отправить</button>
                            </div>
                    </form>
                </div>
            </div>     
              
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



