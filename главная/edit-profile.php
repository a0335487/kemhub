<?
include "path.php";
include "app/controllers/users.php";

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
            <div style="margin-bottom:60px" class="main-content col-12">
                <div class="post post-edit col-5">
                    <div class="col-12">
                        <img src="<?=BASE_URL . 'assets/img/avatars/' . $user['avatar'] ?>" alt="Profile Picture" class="profile-img profile-img-edit" >
                    </div>
                    <div class="mb-12 col-12 col-md-12 err">
                        <?include "app/helps/errorInfo.php";?>
                    </div>
                    <form class="col-12" action="edit-profile.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3 mt-3">    
                            <label for="img" class="form-label">Обновить аватарку</label>
                            <input type="file" name="img">
                        </div>
                        <button class="btn-avatar" type="submit" name="set_avatar">Обновить аватарку</button>
                    </form>
                    <div class="profile-info">
                        <h2><?=$user['username']?></h2>
                        <!-- <div class="info">
                            <p><span>Дата рождения: </span>01.12.2004</p>
                            <p><span>Город: </span>Новокузнецк</p>
                            <p><span>Email: </span><?=$user['email']?></p>
                            <p><span>Телефон: </span>89133030612</p>
                        </div> -->
                        <form action="edit-profile.php" method="post">
                            <div class="mb-3 mt-3">
                                <label for="birthday" class="form-label">Дата рождения:</label>
                                <input type="date" name="birthday" value="<?=$birthday?>">
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Город проживания:</label>
                                <input type="text" name="city" placeholder="г.Новокузнецк" value="<?=$city?>">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Мобильный телефон:</label>
                                <input type="tel" name="phone" placeholder="+1 234 567 8900" value="<?=$phone?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Расскажите немного о себе:</label>
                                <textarea name="about" class="form-control" rows="3"><?=$about;?></textarea>
                            </div>
                            <button class="btn-avatar" type="submit" name="set_profile">Обновить профиль</button>
                        </form>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
<!-- FOOTER -->
<?include("app/include/footer.php");?>
</body>
</html>