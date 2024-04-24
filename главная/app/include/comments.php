<?php
include SITE_ROOT . "/app/controllers/commentaries.php";
$comments = selectCommentsOrderByDesc('comments', $page);
?>

<div class="col-md-12 col-12 comments">
    <h3>Оставить комментарий</h3>
    <div class="err"><p><?=$errMsg?></p></div>
    <form action="<?=BASE_URL . "single.php?post=$page"; ?>" method="post">
        <input type="hidden" name="page" value="<?=$page;?>">
        <!-- <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div> -->
        <div class="mb-3">
            <!-- <label for="exampleFormControlTextarea1" class="form-label">Комментарий</label> -->
            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" name="goComment" class="btn btn-save">Отправить</button>
        </div>
    </form>
    <?php if(count($comments) > 0): ?>
        <div class="row all-comments">
            <h3 class="col-12 h3">Комментарии к проекту</h3>
            <?php foreach($comments as $comment): ?>
                <div class="one-comment col-9">
                    <i class="fa-solid fa-skull"></i><span><?=$comment['email'];?></span>
                    <i class="fa-solid fa-clock"></i><span><?=$comment['created_date'];?></span>
                    <div class="col-12 text">
                    <?=$comment['comment'];?>
                    </div>
                </div>
            <?php endforeach;?>
        </div>  
    <?php endif;?>

</div>