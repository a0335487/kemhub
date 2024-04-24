<?
include SITE_ROOT . "/app/database/db.php";
if (!$_SESSION){
    header('location: ' . BASE_URL . 'login.php');
}

$errMsg = [];
$id = '';
$title= '';
$content = '';
$img = '';
$topic = '';

$users = selectAll('users');
$topics = selectAll('topics');
$posts = selectAll('posts');

$postsAdm = selectAllFromPostsWithUsers('posts', 'users');
$postsUser = selectAllFromPostsWithUsers_2('posts', $_SESSION['id']);

//Код формы создания записи 
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])){

    if(!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\assets\img\posts\\" . $imgName;

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
        array_push($errMsg, "Ошибка получения изображения!");
    }

    $title =  trim($_POST['title']);
    $content =  trim($_POST['content']);
    $topic = trim($_POST['topic']);

    $publish = isset($_POST['publish']) ? 1 : 0;

    if($title === '' || $content === '' || $topic === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($title, 'UTF8') < 7){
        array_push($errMsg, "Название проекта должно быть более 7-ми символов!");
    }else{
        $post = [
            'id_user' => $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => $publish,
            'id_topic' => $topic
            
                
        ];       
        $post = insert('posts', $post);
        $post = selectOne('posts', ['id' => $id]);
        if ($_SESSION['admin'] == 1){
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
        else{
            header('location: ' . BASE_URL . 'posts.php');
        }
    }
}
else{
    $id = '';
    $title ='';
    $content = '';
    $publish = '';
    $topic = '';
}



// Редактирование записи
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){ 
    $post = selectOne('posts', ['id' => $_GET['id']]);
    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $topic = $post['id_topic'];
    $publish = $post['status'];

}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])){
    $id = $_POST['id'];
    $title =  trim($_POST['title']);
    $content =  trim($_POST['content']);
    $topic = trim($_POST['topic']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    if(!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\assets\img\posts\\" . $imgName;

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
        array_push($errMsg, "Ошибка получения изображения!");
    }

    if($title === '' || $content === '' || $topic === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($title, 'UTF8') < 7){
        array_push($errMsg, "Название проекта должно быть более 7-ми символов!");
    }else{
        $post = [
            'id_user' => $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => $publish,
            'id_topic' => $topic
            
                
        ];       
        $post = update('posts', $id ,$post);
        if ($_SESSION['admin'] == 1){
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
        else{
            header('location: ' . BASE_URL . 'posts.php');
        }
    }
}
else{
    $title = $_POST['title'];
    $content = $_POST['content'];
    $publish = isset($_POST['publish']) ? 1 : 0;
    $topic = $_POST['id_topic'];
}


// Публикация категории
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update('posts', $id, ['status' => $publish]);

    $url =  $_SERVER['HTTP_REFERER'];
    $url = explode('/', $url);
    $result = $url[4];
    if ($_SESSION['admin'] == 1){
        if ($result == 'profile.php'){
            header('location: ' . BASE_URL . 'profile.php');
            exit();
        }
        else{
            header('location: ' . BASE_URL . 'admin/posts/index.php');
            exit();
        }
    }
    else{
        
        if ($result == 'profile.php'){
            header('location: ' . BASE_URL . 'profile.php');
            exit();
        }
        else{
            header('location: ' . BASE_URL . 'posts.php');
            exit();
        }
        
    }

}

// Удаление записи
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('posts', $id);

    $url =  $_SERVER['HTTP_REFERER'];
    $url = explode('/', $url);
    $result = $url[4];
    if ($_SESSION['admin'] == 1){
        if ($result == 'profile.php'){
            header('location: ' . BASE_URL . 'profile.php');
        }
        else{
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
    }
    else{
        if ($result == 'profile.php'){
            header('location: ' . BASE_URL . 'profile.php');
        }
        else{
            header('location: ' . BASE_URL . 'posts.php');
        }   
    }
}

?>