<?
include "path.php";
include "app/controllers/users.php";
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <link rel="preload" href="fonts/swis721blkbtrusbyme-black.woff" as="font">
    <link rel="stylesheet" href="assets/css/style_2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="img/ico.ico" type="image/x-icon">.
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->

    <title>KEMHUB - авторизация</title>
</head>
<body>
<div class="main">
    <div class="content">
        <div class="container">
            <form id="sing_form" method="post">
                <h2>Вх<span style="color: #4fb9ff;">од</span></h2>
                <div class="err"><p><?=$errMsg_log?></p></div>
                <input value="<?=$email_log?>" type="email" id="mail_log" placeholder="Email" name="mail_log" autocomplete="off" required>
                <input type="password" id="password" placeholder="Пароль" name="password">
                <input class="button" id="but" type="submit" name="log_but" value="Войти" />
                <a href="" style="margin-top: 20px;" class="foget_pass">Забыли пароль?</a>
            </form>
        </div>
    </div>


    <div id="content_registration" class="content">
        <div class="container">
            <form id="next_form" method="post" action="<?= $_SERVER['SCRIPT_NAME'] ?>">
                <p class="disctiption">Впервые в <span style="color:#4fb9ff">KEMHUB</span>?</p>
                <p class="moment_reg">Моментальная регистрация</p>
                <div class="err"><p><?=$errMsg_reg?></p></div>
                <input value="<?=$surname?>" type="text" id="surname" placeholder="Фамилия" name="surname" autocomplete="off">
                <input value="<?=$name?>" type="text" id="name" placeholder="Имя" name="name" autocomplete="off">
                <!-- <label class="foget_pass" style="text-align: left;" for="date">Дата рождения:</label>
                <div class="date_line">
                    <input id="bd_day" name="bd_day" class="date" type="number" placeholder="ДД" autocomplete="off">
                    <input id="bd_month" name="bd_month" class="date" type="number" placeholder="ММ" autocomplete="off">
                    <input id="bd_year" name="bd_year" class="date" type="number" placeholder="ГГГГ" autocomplete="off">
                </div> -->
                <input value="<?=$email?>" type="email" id="mail_reg" placeholder="Email" name="mail_reg" autocomplete="off" required>
                <input type="password" id="password_1" placeholder="Придумайте пароль" name="password_1" autocomplete="off">
                <input type="password" id="password_2" placeholder="Повторите пароль" name="password_2" autocomplete="off">
             
                <label class="check" style="margin: 10px 0;">
                    <input value="0" id="checkbox" type="checkbox" name="checkbox">
                    <span id="check" class="custom-checkbox">
                        <span class="custom-checkbox-2"></span>
                    </span>
                    <div style="width: 88%; float: right;">Я ознакомился с <span style="color: #4fb9ff;">правлами</span>, политикой 
                    <span style="color: #4fb9ff;">конфиденциальности</span> и принимаю их
                    условия.</div>
                </label>
                <input style="margin-bottom: 20px;" class="button" id="reg_but" type="submit" name="reg_but" value="Зарегистрироваться"/>               
            </form>
        </div>
    </div>

</div>

<div class="content_2">
    <div class="container_2">
        <h3>KEMHUB</h3>
        <p class="disctiption">Социальная сеть, созданная для общения всех людей и объединения их в одном виртуальном пространстве.
            Независимо от того, чем вы интересуетесь или где вы находитесь, <span style="color:#4fb9ff">KemHub</span> всегда предлагает возможность быть соединенным.
        </p>
        <img class="intro" src="assets/img/Группа 2.png">
    </div>
</div>


<div class="foot">
    <div class="footer" style="background-color: rgba(0, 0, 0, 0.05);">
        <span class="disctiption" style="font-size: 16px;">© 2024 Designed by Kafian Aristagets:</span>
        <a class="disctiption" style="color:#4fb9ff; font-size: 16px;" href="#">KEMHUB.ru</a>
  </div>
</div>

</body>
</html>