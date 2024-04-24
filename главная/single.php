<?
include("path.php");
include "app/controllers/topics.php";
$post = selectPostFromPostsWithUsersOnSingle('posts', 'users', $_GET['post']);

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

<link href="assets/css/style.css" rel="stylesheet">
</head>
  <body>
    
  <?include("app/include/header.php");?>

<!-- MAIN -->
<div class="container">
    <div class="content row">
        <div class="main-content col-md-9 col-12">
            <br>
            <h2><?php echo $post['title'];?></h2>


            <div class="single_post row">
                <div class="img col-12">
                    <img src="<?=BASE_URL . 'assets/img/posts/' . $post['img'] ?>" alt="<?=$post['title']?>" class="img-thumbnail img-thumbnail-hack">
                </div>
                <div class="info">
                    <i class="fa-solid fa-user-ninja"></i></i></i><span class="author"> <?=$post['username']?></span>
                    <i class="fa-solid fa-calendar-days"></i></i><span class="author"> <?=$post['created_date']?></span>
                </div>
                <div class="single_post col-12">
                    <?=$post['content'];?>
                </div>
                <!-- Комментарии -->
                <?php include "app/include/comments.php";?>
            </div>      

        </div>
        <div class="sidebar col-md-3 col-12">

            <div class="section search">
                <h3>Поиск</h3>
                <form action="" method="post">
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
  </body>
</html>