<?
include "path.php";
include "app/controllers/posts.php";

$posts = selectAllFromPostsWithUsers_2('posts', $_SESSION['id']);
$user = selectOne('users', ['id' => $_SESSION['id']]);

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body style="background: #1b1b1b;">
    <?include("app/include/header.php");?>
    <div class="container">
        <div class="content-profile row">
            <div class="main-content col-12">
                <div class="post row">
                    <div class="col-4">
                        <a href="<?=BASE_URL . 'edit-profile.php'?>"><img src="<?=BASE_URL . 'assets/img/avatars/' . $user['avatar'] ?>" alt="Profile Picture" class="profile-img"></a>
                    </div>
                    <div class="col-8 profile-info">
                        <h2><?=$user['username']?></h2>
                        <div class="info">
                            <?if ($user['birthday'] != null): ?>
                                <p><span>Дата рождения: </span><?=$user['birthday']?></p>
                            <?endif;?>
                            <?if ($user['city'] != null): ?>
                                <p><span>Город: </span><?=$user['city']?></p>
                            <?endif;?>
                            <p><span>Email: </span><?=$user['email']?></p>
                            <?if ($user['city'] != null): ?>
                                <p><span>Телефон: </span><?=$user['phone']?></p>
                            <? endif;?>
                            <br>
                            <?if ($user['about'] != null): ?>
                                <p><span>О себе: </span><?=$user['about']?></p>
                            <? endif;?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-edit row col-12">
                    <a href="<?=BASE_URL . 'edit-profile.php'?>" class="col-3 btn btn-prof"><i class="fa-solid fa-pen-to-square" style="color: #74C0FC;"></i>Редактировать профиль</a>
                    <span class="col-1"></span>
                    <a href="<? echo BASE_URL . "posts_created.php"?>" class="col-3 btn btn-prof"><i class="fa-regular fa-square-plus" style="color: #74C0FC;"></i>Добавить запись</a>
            </div>

            <div class="main-content my-posts col-12">
                <!-- <div class="post row">
                    <div class="user-info row">
                        <div class="col-1">
                            <img src="assets/img/Минимализм.jpg" alt="Profile Picture" class="profile-img profile-img-small">
                        </div>
                        <div class="col-11">
                            <h4>Аристагец Кафьян</h4>
                            <p>28-01-2024</p>
                        </div>
                    </div>
                    <div class="col-8 profile-info">
                        <h2>Аристагец Кафьян</h2>
                        <div class="info">
                            <p><span>Дата рождения: </span>01.12.2004</p>
                            <p><span>Город: </span>Новокузнецк</p>
                            <p><span>Email: </span>Aristageck@gmail.com</p>
                            <p><span>Телефон: </span>89133039600</p>
                        </div>
                    </div>
                </div> -->

                <div class="my-posts-word row col-2">
                    <h4>Мои <span>записи</span></h4>
                </div>
                <?php if($posts != null): ?>
                    <?php foreach($posts as $post): ?>
                    <div class="post row">
                        <div class="img col-12 col-md-4">
                            <img src="<?=BASE_URL . 'assets/img/posts/' . $post['img'] ?>" alt="<?=$post['title']?>" class="img-thumbnail img-thumbnail-hack">
                        </div>
                        <div class="post_text col-12 col-md-8">
                            <div class="manage">
                                <a href="edit_posts.php?id=<?=$post['id'];?>"><i class="fa-solid fa-pen-to-square" style="color: #74C0FC;"></i></a>
                                <a href="edit_posts.php?delete_id=<?=$post['id'];?>"><i class="fa-solid fa-trash-can" style="color: #ff0000;"></i></a>
                                <? if($post['status']): ?>
                                    <a href="edit_posts.php?publish=0&pub_id=<?=$post['id'];?>"><i class="fa-solid fa-eye" style="color: #FFD43B;"></i></a>
                                <? else: ?>
                                    <a href="edit_posts.php?publish=1&pub_id=<?=$post['id'];?>"><i class="fa-solid fa-eye-slash" style="color: #FFD43B;"></i></a>
                                <?endif;?>
                            </div>
                            <h3>
                                <?php if(strlen($post['title']) > 70): ?>
                                    <a href="<?=BASE_URL . 'single.php?post=' . $post['id']?>"><?=mb_substr($post['title'], 0, 70, 'UTF-8') . '...'?></a>
                                <?php else: ?>
                                    <a href="<?=BASE_URL . 'single.php?post=' . $post['id']?>"><?=$post['title']?></a>
                                <?php endif;?>
                            </h3>
                            <i class="fa-solid fa-user-ninja"></i><span class="author"> <?=$user['username']?></span>
                            <i class="fa-solid fa-calendar-days"></i><span class="author"> <?=$post['created_date']?></span>
                            <p class="preview-text">
                                <?=mb_substr($post['content'], 0, 300, 'UTF-8') . '...'?>
                            </p>
                        
                            <??>
                            <div class="post-info">
                                <i class="fa fa-thumbs-o-up like-btn" data-id="<?=$post['id']?>"></i>
                                <i class="fa fa-thumbs-o-down dislike-btn" data-id="<?=$post['id']?>"></i>
                                <i class="fa-regular fa-comment" style="color: #ffffff;"></i><span><?=countComments('comments', $post['id'])['count']?></span>
                            </div>

                        </div>
                    </div>
                    <?php endforeach;?>
                <?else:?>
                    <div class="col-6 no_category" style="margin:60px auto;">
                       У вас пока нет записей!<br>
                        Добавить запись вы можете во складке "Мои записи".
                    </div>           
                <?endif;?>
            </div>
        </div>
    </div>
<!-- FOOTER -->
<?include("app/include/footer.php");?>
</body>
</html>