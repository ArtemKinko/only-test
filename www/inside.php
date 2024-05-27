<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Страница пользователя</title>
    <link href="assets/app.css" rel="stylesheet"/>
    <?php
    require_once __DIR__ . '/utils/redirect.php';

    session_start();
        if(empty($_SESSION['current_user'])) {
            redirect("login.php");
        }
    ?>
</head>
<body>
<div class="content">
    <form action="actions/update.php" method="post" id="login_form">
        <div class="column">
            <h1>Страница пользователя</h1>
            <a href="actions/logout.php">Выйти</a>

            <div class="row">
                <label>Имя:</label>
                <input type="text" id="name" name="name" required placeholder="Артем" value="<?php echo $_SESSION['current_user']['name'] ?? '' ?>"/>
            </div>

            <?php if (isset($_SESSION['validation']['name'])) : ?>
                <div class="warning"> <?php echo $_SESSION['validation']['name'] ?> </div>
            <?php endif; ?>

            <div class="row">
                <label>Телефон:</label>
                <input type="tel" id="phone" name="phone" pattern="+7[0-9]{10}" required placeholder="+79221112233" value="<?php echo $_SESSION['current_user']['phone'] ?? '' ?>"/>
            </div>

            <?php if (isset($_SESSION['validation']['phone'])) : ?>
                <div class="warning"> <?php echo $_SESSION['validation']['phone'] ?> </div>
            <?php endif; ?>

            <div class="row">
                <label>Почта:</label>
                <input type="email" id="email" name="email" required placeholder="mail@gmail.com" value="<?php echo $_SESSION['current_user']['email'] ?? '' ?>"/>
            </div>

            <?php if (isset($_SESSION['validation']['email'])) : ?>
                <div class="warning"> <?php echo $_SESSION['validation']['email'] ?> </div>
            <?php endif; ?>

            <div class="row">
                <label>Новый пароль:</label>
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

            <input class="button" type="submit" id="submit" value="Изменить"/>

            <?php if (isset($_SESSION['validation']['success'])) : ?>
                <div class="success"> <?php echo $_SESSION['validation']['success'] ?> </div>
            <?php endif; ?>
        </div>
    </form>
    <?php $_SESSION['validation'] = [] ?>
</div>
</body>
</html>