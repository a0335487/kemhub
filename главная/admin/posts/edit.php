<?
include "../../path.php";
include "../../app/controllers/posts.php";
?>

<!doctype html>
<html lang="ru">
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
                <div class="row title-table">
                    <h2>Редактирование проекта</h2>                  
                </div>
                <br>
                <div class="row add-post">
                <div class="mb-12 col-12 col-md-12 err">
                        <?include "../../app/helps/errorInfo.php";?>
                    </div>
                    <form action="edit.php" method="post" enctype="multipart/form-data">

                    <input value="<?=$id;?>" name="id" type="hidden" >

                        <div class="col mb-4">
                            <input value="<?=$post['title'];?>" name="title" type="text" class="form-control form-post" placeholder="Title" aria-label="Название проекта">
                        </div>
                        <div class="col mb-4">
                            <label for="editor" class="form-label p">Содержимое проекта</label>
                            <textarea name="content" class="form-control form-post" id="editor" rows="6"><?=$post['content'];?></textarea>
                        </div>
                        <div class="input-group col mb-4">
                            <input name="img" type="file" class="form-control form-post" id="inputGroupFile02">
                            <label class="input-group-text up" for="inputGroupFile02">Upload</label>
                        </div>
                        <!-- <label for="content" class="p mb-2">Дополнительные файлы</label>
                        <div class="input-group col mb-4">
                            <input type="file" class="form-control form-post" id="inputGroupFile03">
                            <label class="input-group-text up" for="inputGroupFile02">Upload</label>
                        </div>
                        <div class="input-group col mb-4">
                            <input type="file" class="form-control form-post" id="inputGroupFile04">
                            <label class="input-group-text up" for="inputGroupFile02">Upload</label>
                        </div> -->
                        <label for="topics" class="form-label p">Категория проекта</label>
                        <select name="topic" class="form-select form-post mb-2" aria-label="Default select example">
                            <?foreach ($topics as $key => $topic): ?>
                                <option value="<?=$topic['id'];?>"><?=$topic['name'];?></option>
                            <? endforeach; ?>
                        </select>
                        <div class="col-12 mb-2">
                            <div class="form-check">
                                <?php if(empty($publish) || $publish == 0): ?>
                                    <input name="publish" class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Опубликовать
                                    </label>
                                <?php else: ?>
                                    <input name="publish" class="form-check-input" type="checkbox" id="gridCheck" checked>
                                    <label class="form-check-label" for="gridCheck">
                                        Опубликовать
                                    </label>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <button name="edit_post" class="btn btn-primary" type="submit">Сохранить запись</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>

    <?include("../../app/include/admin-footer.php");?>
    <!-- Добавление редактора записи проекта -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <script src="../../assets/js/script.js"></script>
  </body>
</html>