<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Форма авторизации</title>
    <link href="assets/app.css" rel="stylesheet"/>
    <?php
    session_start();
    require_once __DIR__ . '/utils/redirect.php';
    if(!empty($_SESSION['current_user'])) {
        redirect("inside.php");
    }
    ?>
</head>
<body>
<div class="content">
    <form action="actions/login.php" method="post" id="login_form">
        <div class="column">
            <h1>Авторизация</h1>
            <small>или</small>
            <a href="register.php">Зарегистрироваться</a>

            <div class="row">
                <label>Телефон или почта</label>
                <input type="text" id="phone_mail" name="phone_mail" placeholder="+78001112233"/>
            </div>

            <?php if (isset($_SESSION['validation']['phone_mail'])) : ?>
                <div class="warning"> <?php echo $_SESSION['validation']['phone_mail'] ?> </div>
            <?php endif; ?>

            <div class="row">
                <label>Пароль:</label>
                <input type="password" id="password" name="password"/>
            </div>

            <?php if (isset($_SESSION['validation']['password'])) : ?>
                <div class="warning"> <?php echo $_SESSION['validation']['password'] ?> </div>
            <?php endif; ?>

            <input class="button" type="submit" id="submit" value="Войти"/>
        </div>
    </form>
    <?php $_SESSION['validation'] = [] ?>
</div>
</body>
</html>