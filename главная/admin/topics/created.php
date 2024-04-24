<?
include "../../path.php";
include "../../app/controllers/topics.php";
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
                    <a href="<? echo BASE_URL . "admin/topics/created.php";?>" class="col-3 btn btn-save">Добавить</a>
                    <span class="col-1"></span>
                    <a href="<? echo BASE_URL . "admin/topics/index.php";?>" class="col-3 btn btn-man">Редактировать</a>
                </div>
                <div class="row title-table mb-4">
                    <h2>Создание категории</h2>                  
                </div>
                <div class="row add-post">
                    <div class="mb-12 col-12 col-md-12 err">
                        <p><?=$errMsg?></p>
                    </div>
                    <form action="created.php" method="post">
                        <div class="col mb-4">
                            <input name ="name" value="<?=$name?>" type="text" class="form-control form-post" placeholder="Имя категории" aria-label="Имя категории">
                        </div>
                        <div class="col mb-4">
                            <label for="content" class="form-label p">Описание категории</label>
                            <textarea name="description" class="form-control form-post" id="content" rows="6"><?=$description?></textarea>
                        </div>
                        <div class="col mb-4">
                            <button name="topic-create" class="btn btn-primary" type="submit">Создать категорию</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>

    <?include("../../app/include/admin-footer.php");?>
  </body>
</html>