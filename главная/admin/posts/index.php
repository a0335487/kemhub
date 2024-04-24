<?
include "../../path.php";
include "../../app/controllers/posts.php";

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
                    <a href="<? echo BASE_URL . "admin/posts/created.php";?>" class="col-3 btn btn-save">Добавить</a>
                    <span class="col-1"></span>
                    <a href="<? echo BASE_URL . "admin/posts/index.php";?>" class="col-3 btn btn-man">Редактировать</a>
                </div>
                <div class="row title-table">
                    <h2>Управление записями</h2>
                    <div class="col-1">ID</div>
                    <div class="col-5">Название</div>
                    <div class="col-2">Автор</div>
                    <div class="col-4">Управление</div>
                </div>
                <? foreach ($postsAdm as $key => $post): ?>
                <div class="row post">
                    <div class="id col-1"><?=$key + 1;?></div>
                    <div class="title col-5">
                        <?php if(strlen($post['title']) > 60): ?>
                            <?=mb_substr($post['title'], 0, 40, 'UTF-8') . '...'?>
                        <?php else: ?>
                            <?=$post['title']?>
                        <?php endif;?>
                    </div>
                    <div class="author col-2"><?=$post['username'];?></div>
                    <div class="red col-1"><a href="edit.php?id=<?=$post['id'];?>">Edit</a></div>
                    <div class="del col-1"><a href="edit.php?delete_id=<?=$post['id'];?>">Delete</a></div>
                    <? if($post['status']): ?>
                        <div class="status col-2"><a href="edit.php?publish=0&pub_id=<?=$post['id'];?>">Unpublish</a></div>
                    <? else: ?>
                        <div class="status col-2"><a href="edit.php?publish=1&pub_id=<?=$post['id'];?>">Publish</a></div>
                    <?endif;?>
                </div>
                <? endforeach; ?>
            </div>
        </div>
</div>

    <?include("../../app/include/admin-footer.php");?>
  </body>
</html>