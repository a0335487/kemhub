<?
session_start();
include "../../path.php";
include "../../app/controllers/users.php";
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

<link href="../../assets/css/admin.css" rel="stylesheet">
</head>
  <body>
    <?include("../../app/include/admin-header.php");?>

    
<div class="container">
<? include "../../app/include/sidebar-admin.php";?>
            <div class="posts col-9">
                <div class="button row">
                    <a href="<? echo BASE_URL . "admin/users/created.php";?>" class="col-3 btn btn-save">Добавить</a>
                    <span class="col-1"></span>
                    <a href="<? echo BASE_URL . "admin/users/index.php";?>" class="col-3 btn btn-man">Редактировать</a>
                </div>
                <div class="row title-table">
                    <h2>Обновить пользователя</h2>                  
                </div>
                <div class="row add-post">
                <div class="mb-12 col-12 col-md-12 err">
                        <?include "../../app/helps/errorInfo.php";?>
                    </div>
                    <form action="edit.php" method="post" class="row g-3">
                        <input value="<?=$id;?>" name="id" type="hidden" >
                        <div class="col-12 mb-4">
                            <input name="name" value="<?=$username?>" type="text" class="form-control form-post" placeholder="Логин" aria-label="First name">
                        </div>
                        <div class="col-12 mb-4">
                            <input name="mail" value="<?=$email?>" type="email" placeholder="Email" class="form-control form-post-ro" id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
                        </div>
                        <div class="col-md-6">
                            <input name="password_1" type="password" placeholder="Сбросить пароль" class="form-control form-post" id="exampleInputPassword1">
                        </div>
                        <div class="col-md-6">
                            <input name="password_2" type="password"  placeholder="Повторите пароль" class="form-control form-post" id="exampleInputPassword1">
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input name="admin" value="1" class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Admin
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button name="update-user" class="btn btn-primary" type="submit">Обновить пользователя</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>

    <?include("../../app/include/admin-footer.php");?>
  </body>
</html>