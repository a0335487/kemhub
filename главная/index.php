<?
include "path.php";
include "app/controllers/topics.php";

// $posts = selectAllFromPostsWithUsersOnIndex('posts', 'users');

$page = isset($_GET['page']) ? $_GET['page']: 1;
$limit = 4;
$offset = $limit * ($page-1);
$total_pages = round(countRow('posts') / $limit, 0);

$posts = selectAllFromPostsWithUsersOnIndex('posts', 'users', $limit, $offset);

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
  <body>
    <?include("app/include/header.php");?>
<!-- Блок карусели -->
<div class="container">
    <div class="row">
        <!-- <h2 class="slider-title">Лучшие проекты</h2> -->
        <br><br>
    </div>
    <div class="back">
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-inner">
        <div class="carousel-item">
            <img src="assets/img/1 слайд.jpeg" class="d-block w-100" alt="...">
            <div class="carousel-caption carousel-caption-hack d-none d-md-block">
                <h5><a href="#">Информационные проекты</a></h5>
            </div>
        </div>
        <div class="carousel-item active">
            <img src="assets/img/2 слайд.jpeg" class="d-block w-100" alt="...">
            <div class="carousel-caption carousel-caption-hack d-none d-md-block">
                <h5><a href="#">Исскуственный интелект</a></h5>
            </div>
        </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
</div>

<!-- MAIN -->
<div class="container">
    <div class="content row">
        <div class="main-content col-md-9 col-12">
            <h2>Последние <span>публикации</span></h2>

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
                        <a href="<?=BASE_URL . 'chat.php?user=' . $post['id_user'] . '-' . $_SESSION['id'];?>"><i class="fa-solid fa-user-ninja"></i><span class="author"> <?=$post['username']?></span></a>
                        <i class="fa-solid fa-calendar-days"></i><span class="author"> <?=$post['created_date']?></span>
                        <p class="preview-text">
                            <?=mb_substr($post['content'], 0, 180, 'UTF-8') . '...'?>
                        </p>
                       
                        <div class="post-info">
                            <i class="fa fa-thumbs-o-up like-btn" data-id="<?=$post['id']?>"></i>
                            <i class="fa fa-thumbs-o-down dislike-btn" data-id="<?=$post['id']?>"></i>
                            <i class="fa-regular fa-comment" style="color: #ffffff;"></i><span><?=countComments('comments', $post['id'])['count']?></span>
                        </div>

                    </div>
                </div>
            <?php endforeach;?>
            <!-- Навигация -->
        <?include "app/include/pagination.php";?>
        </div>


        <div class="sidebar col-md-3 col-12">

            <div class="section search">
                <h3>Поиск</h3>
                <form action="search.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Search...">
                </form>
            </div>
            <div class="section topics">
                <h3>Категории</h3>
                <ul>
                    <?foreach ($topics as $key => $topic): ?>
                    <li>
                        <a href="<?=BASE_URL . 'category.php?id=' . $topic['id'];?>"><?=$topic['name'];?></a>
                    </li>
                    <?endforeach;?>

                </ul>
            </div>

        </div>
    </div>
</div>

<!-- FOOTER -->
<?include("app/include/footer.php");?>
<script src="assets/js/script.js"></script>
<script src="assets/js/like.js"></script>
  </body>
</html>