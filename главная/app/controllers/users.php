<?
include SITE_ROOT . "/app/database/db.php";

$errMsg = [];
$errMsg_log = '';
$errMsg_reg = '';

function userAuth($user){
    $_SESSION['id'] = $user['id'];
    $_SESSION['login'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];

    if($_SESSION['admin']){
        header('location: ' . BASE_URL . "admin/posts/index.php");
    }else{
        header('location: ' . BASE_URL);
    }
}

$users = selectAll('users');

$name =  '';
$surname = '';
$email = '';

//Код для регистрации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reg_but'])){
    $name =  trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $login = trim($_POST['surname']) . " " . trim($_POST['name']);
    $email = trim($_POST['mail_reg']);
    $pass1 = trim($_POST['password_1']);
    $pass2 = trim($_POST['password_2']);
    $admin = 0;

    $agree = isset($_POST['checkbox']) ? 1 : 0;

    if($surname === '' || $email === '' || $pass1 === '' || $name === ''){
        $errMsg_reg = "Не все поля заполнены!";
    }
    elseif ($pass1 !== $pass2){
        $errMsg_reg = "Пароли должны совпадать!";
    }
    elseif ($agree != 1){
        $errMsg_reg = "Подвердите, что вы согласны с условиями KemHub!";
    }
    else{
        $existence = selectOne('users', ['email' => $email]);
        if ($existence['email'] === $email){
            $errMsg_reg = "Пользователь с таким email уже существует!";
        }
        else{
            $pass = password_hash($pass1, PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass,
                'avatar' => "noavatar.jpeg"
                
            ];       
            $id = insert('users', $post);
            $user = selectOne('users', ['id' => $id]);
            userAuth($user);
    }
}
   
    // $last_row = selectOne('users', ['id' => $id]);   
}
else{
    $name =  '';
    $surname = '';
    $email = '';
    $agree = '';
}

//Код для авторизации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log_but'])){
    $email_log = trim($_POST['mail_log']);
    $pass = trim($_POST['password']);
    if($email_log === '' || $pass === ''){
        $errMsg_log ="Не все поля заполнены!";
    }else{
        $existence = selectOne('users', ['email' => $email_log]);
        if($existence && password_verify($pass, $existence['password'])){
            userAuth($existence);
        }else{
            $errMsg_log = "Почта либо пароль введены неверно!";
        }
    }
}else{
    $email_log = '';
}



//Код добавления пользователя в admin
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])){
   
    $name =  trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $login = trim($_POST['surname']) . " " . trim($_POST['name']);
    $email = trim($_POST['mail']);
    $pass1 = trim($_POST['password_1']);
    $pass2 = trim($_POST['password_2']);
    $admin = 0;

    if($email === '' || $pass1 === '' || $name === '' || $surname === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }
    elseif ($pass1 !== $pass2){
        array_push($errMsg, "Пароли должны совпадать!");
    }
    else{
        $existence = selectOne('users', ['email' => $email]);
        if ($existence['email'] === $email){
            array_push($errMsg, "Пользователь с таким email уже существует!");
        }
        else{
            $pass = password_hash($pass1, PASSWORD_DEFAULT);
            if(isset($_POST['admin'])){
                $admin = 1;
            }
            $user = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass,
                'avatar' => "noavatar.jpeg"
            ];       
            $id = insert('users', $user);
            $user = selectOne('users', ['id' => $id]);
            userAuth($user);
    }
}
   
    // $last_row = selectOne('users', ['id' => $id]);   
}
else{
    $name ='';
    $surname = '';
    $email = '';
}



// Удаление user в админке 
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('users', $id);
    header('location: ' . BASE_URL . 'admin/users/index.php');
}


// Редактирование пользователя in admin
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])){ 
    $user = selectOne('users', ['id' => $_GET['edit_id']]);

    $id = $user['id'];
    $admin = $user['admin'];
    $username = $user['username'];
    $email = $user['email'];

}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])){
    $id = $_POST['id'];
    $login =  trim($_POST['name']);
    $mail =  trim($_POST['mail']);
    $pass1 = trim($_POST['password_1']);
    $pass2 = trim($_POST['password_2']);
    $admin = isset($_POST['admin']) ? 1 : 0;


    if($login === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($login, 'UTF8') < 2){
        array_push($errMsg, "Логин должен быть более 2-x символов!");
    }elseif ($pass1 !== $pass2){
        array_push($errMsg, "Пароли должны совпадать!");
    }else{
        $pass = password_hash($pass1, PASSWORD_DEFAULT);
        if(isset($_POST['admin'])){
            $admin = 1;
        }
        $user = [
            'admin' => $admin,
            'username' => $login,
            // 'email' => $mail,
            'password' => $pass
        ];       
        $user = update('users', $id ,$user);
        header('location: ' . BASE_URL . 'admin/users/index.php');
    }
}
else{
    $mail = '';
    $login = '';
}


// // Редактирование автарки профиля
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['set_avatar'])){
    $id = $_SESSION['id'];
    $img = trim($_POST['img']); 
    if(!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\assets\img\avatars\\" . $imgName;

        if(strpos($fileType, 'image') === false){
            array_push($errMsg, "Можно загружать только изображения!");
        }else {
            $result = move_uploaded_file($fileTmpName, $destination);

            if($result){
                $_POST['img'] = $imgName;
            }else{
                array_push($errMsg, "Ошибка загрузки изображения на сервер!");
            }
        }
    }else{
        // array_push($errMsg, "Ошибка получения изображения!");
    }
    if ($_POST['img'] === ''){
        array_push($errMsg, "Ошибка получения изображения!");
        
    }
    else{
        $user = [
            'avatar' => $_POST['img']
        ];       
        $user = update('users', $id ,$user);
        header('location: ' . BASE_URL . 'profile.php');
    }
}
else{
   $img = '';
}


$dop_ifo = selectOne('users', ['id' => $_SESSION['id']]);
$birthday = $dop_ifo['birthday'];
$city = $dop_ifo['city'];
$phone = $dop_ifo['phone'];
$about = $dop_ifo['about'];
// // Редактирование доп.инфы профиля
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['set_profile'])){
    $id = $_SESSION['id'];
    $birthday = $_POST['birthday']; 
    $city = trim($_POST['city']);
    $phone = trim($_POST['phone']);
    $about = trim($_POST['about']);
    $user = [
        'birthday' => $birthday,
        'city' => $city,
        'phone' => $phone,
        'about' => $about
    ];       
    $user = update('users', $id ,$user);
    header('location: ' . BASE_URL . 'profile.php');
}
else{
    // $birthday = '';
    // $city = '';
    // $phone = '';
}


?>