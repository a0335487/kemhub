<?php



$page = $_GET['post'];
$email = '';
$comment = '';
$errMsg = '';
$status = 1;
$comments = [];


//Код формы создания comments 
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])){
    if (!$_SESSION){
        $errMsg = "Чтобы оставить комментарий, необходимо зарегистрироваться!";
    }
    else{
        // $email =  trim($_POST['email']);
        $commentar =  trim($_POST['comment']);
        if($commentar === ''){
            $errMsg = "Поле не заполнено!";
        }else
        {
            $user = selectOne('users', ['id' => $_SESSION['id']]);
            $comment = [
                'status' => $status,
                'page' => $page,
                'comment' => $commentar,
                'email' => $user['email']           
            ];       
            $comment = insert('comments', $comment);
            $comments = selectAll('comments', ['page' => $page, 'status' => 1]);              
        }
    }
}
else{
    $commentar = '';
    $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
}
