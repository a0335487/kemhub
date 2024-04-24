<?include "path.php";
include SITE_ROOT . "/app/database/db.php";
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term'])){
    $text = $_POST['search-term'];
    if(searchInTitleAndContent($_POST['search-term'], 'posts', 'users') == null){

        echo "<script>";
        echo "window.location = 'index.php';";
        echo "alert('Проектов содержащих слово `$text` не найдено!');";
        echo "</script>";
    }
    else{
        $posts = searchInTitleAndContent($_POST['search-term'], 'posts', 'users');
       
    }
}

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

<link href="assets/css/style.css" rel="stylesheet">
</head>
  <body>
    <?include("app/include/header.php");?>
<!-- Блок карусели -->

<!-- MAIN -->
<div class="container">
    <div class="content row">
        <div class="main-content col-12">
            <h2>Результаты <span>поиска</span></h2>

            <?php foreach($posts as $post): ?>
                <div class="post row">
                    <div class="img col-12 col-md-4">
                        <img src="<?=BASE_URL . 'assets/img/posts/' . $post['img'] ?>" alt="<?=$post['title']?>" class="img-thumbnail img-thumbnail-hack">
                    </div>
                    <div class="post_text col-12 col-md-8">
                        <h3>
                            <?php if(strlen($post['title']) > 70): ?>
                                <a href="<?=BASE_URL . 'single.php?post=' . $post['id']?>"><?=mb_substr($post['title'], 0, 70, 'UTF-8') . '...'?></a>
                            <?php else: ?>
                                <a href="<?=BASE_URL . 'single.php?post=' . $post['id']?>"><?=$post['title']?></a>
                            <?php endif;?>
                        </h3>
                        <i class="far fa-user"><span class="author"> <?=$post['username']?></span></i>
                        <i class="far fa-calendar"><span class="author"> <?=$post['created_date']?></span></i>
                        <p class="preview-text">
                            <?=mb_substr($post['content'], 0, 500, 'UTF-8') . '...'?>
                        </p>
                    </div>
                </div>
            <?php endforeach;?>
        </div>


    
    </div>
</div>

<!-- FOOTER -->
<?include("app/include/footer.php");?>
  </body>
</html>