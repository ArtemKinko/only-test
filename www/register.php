<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Форма регистрации</title>
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
    <form action="actions/register.php" method="post" id="login_form">
        <div class="column">
            <h1>Регистрация</h1>
            <small>или</small>
            <a href="login.php">Войти</a>

            <div class="row">
                <label>Имя:</label>
                <input type="text" id="name" name="name" required placeholder="Артем" value="<?php echo $_SESSION['registration_input']['name'] ?? '' ?>"/>
            </div>

            <?php if (isset($_SESSION['validation']['name'])) : ?>
                <div class="warning"> <?php echo $_SESSION['validation']['name'] ?> </div>
            <?php endif; ?>

            <div class="row">
                <label>Телефон:</label>
                <input type="tel" id="phone" name="phone" pattern="+7[0-9]{10}" required placeholder="+78001112233" value="<?php echo $_SESSION['registration_input']['phone'] ?? '' ?>"/>
            </div>

            <?php if (isset($_SESSION['validation']['phone'])) : ?>
                <div class="warning"> <?php echo $_SESSION['validation']['phone'] ?> </div>
            <?php endif; ?>

            <div class="row">
                <label>Почта:</label>
                <input type="email" id="email" name="email" required placeholder="mail@gmail.com" value="<?php echo $_SESSION['registration_input']['email'] ?? '' ?>"/>
            </div>

            <?php if (isset($_SESSION['validation']['email'])) : ?>
                <div class="warning"> <?php echo $_SESSION['validation']['email'] ?> </div>
            <?php endif; ?>

            <div class="row">
                <label>Пароль:</label>
                <input type="password" id="password" name="password" required/>
            </div>

            <?php if (isset($_SESSION['validation']['password'])) : ?>
                <div class="warning"> <?php echo $_SESSION['validation']['password'] ?> </div>
            <?php endif; ?>

            <div class="row">
                <label>Повторите пароль:</label>
                <input type="password" id="repeat_password" name="repeat_password" required/>
            </div>

            <?php if (isset($_SESSION['validation']['repeat_password'])) : ?>
                <div class="warning"> <?php echo $_SESSION['validation']['repeat_password'] ?> </div>
            <?php endif; ?>

            <input class="button" type="submit" id="submit" value="Зарегистрироваться"/>
        </div>
    </form>
    <?php $_SESSION['validation'] = [] ?>
</div>
</body>
</html>