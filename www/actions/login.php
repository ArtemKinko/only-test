<?php

session_start();
require_once __DIR__ . '/../utils/redirect.php';
require_once __DIR__ . '/../utils/check_phone.php';
require_once __DIR__ . '/../utils/db_connector.php';

$phone_mail = $_POST['phone_mail'];
$password = $_POST['password'];

$_SESSION['validation'] = [];

$user = [];

if (empty($phone_mail)) {
    $_SESSION['validation']['phone'] = 'Телефон или почта не могут быть пустыми';
}
else {
    if (check_phone($phone_mail)) {
        $user = findUserByPhone($phone_mail);
    }
    if (filter_var($phone_mail, FILTER_VALIDATE_EMAIL)) {
        $user = findUserByEmail($phone_mail);
    }
}

if (empty($user)) {
    $_SESSION['validation']['phone_mail'] = 'Нет пользователя с таким телефоном или почтой';
}

if (empty($password)) {
    $_SESSION['validation']['password'] = 'Пароль не может быть пустым';
}

if (!empty($_SESSION['validation'])) {
    redirect("login.php");
}
else {

    if (password_verify($password, $user['password'])) {
        $_SESSION['current_user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'phone' => $user['phone'],
            'email' => $user['email'],
        ];
        redirect("inside.php");
    }
    else {
        $_SESSION['validation']['password'] = 'Пароль неверный';
        redirect("login.php");
    }
}