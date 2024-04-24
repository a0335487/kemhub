<header class="container-fluid">

        <div class="container">
            <div class="row">
                <div class="col-4">
                    <h1>
                        <a href="<?echo BASE_URL?>">KEM<span>HUB</span></a>
                    </h1>
                </div>
                <nav class="col-8">
                    <ul>
                        <li><a href="<?echo BASE_URL?>">Главная</a></li>
                        <li><a href="<? echo BASE_URL . "chat.php";?>">Чаты</a></li>
                        <li><a href="#">О нас</a></li>
                        <li><a href="<? echo BASE_URL . "posts.php";?>">Мои записи</a></li>
                        <li>
                            <?if (isset($_SESSION['id'])): ?>
                                <a href="<? echo BASE_URL . "profile.php";?>">
                                <i class="fa-regular fa-circle-user" style="color: #ffffff;"></i>
                                <? echo $_SESSION['login'];?>
                            </a>
                            <ul>
                                <?if ($_SESSION['admin']): ?>
                                    <li><a href="<? echo BASE_URL . "admin/posts/index.php";?>">Админ панель</a></li>
                                <? endif; ?>
                                <li><a href="<? echo BASE_URL . "logout.php";?>">Выход</a></li>
                            </ul>
                            <? else: ?>
                                <a href="<? echo BASE_URL . "login.php";?>">
                                <!-- <i class="fa-regular fa-circle-user" style="color: #ffffff;"></i> -->
                                Личный кабинет
                            </a>
                            <ul>
                                <li><a href="<? echo BASE_URL . "login.php";?>">Регистрация</a></li>
                            </ul>
                            <? endif; ?>
                           
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
