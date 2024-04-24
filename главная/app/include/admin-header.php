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
                        <li><a href="<? echo BASE_URL . "index.php";?>">Главная</a></li>
                        <li>
                            <a href="<? echo BASE_URL . "profile.php";?>">
                                <i class="fa-regular fa-circle-user" style="color: #ffffff;"></i>
                                <? echo $_SESSION['login'];?>
                            </a>
                        </li>
                       
                            <li><a href="<? echo BASE_URL . "logout.php";?>">Выход</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
