<?php

session_start();
require_once __DIR__ . '/../utils/redirect.php';
require_once __DIR__ . '/../utils/check_phone.php';
require_once __DIR__ . '/../utils/db_connector.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$repeat_password = $_POST['repeat_password'];

$_SESSION['registration_input'] = [
    'name' => $name,
    'phone' => $phone,
    'email' => $email,
];

$error_message = "";

$_SESSION['validation'] = [];

if (empty($name)) {
    $_SESSION['validation']['name'] = 'Имя введено неверно';
}

if (empty($phone) || !check_phone($phone)) {
    $_SESSION['validation']['phone'] = 'Телефон введен неверно';
}
elseif (isPhoneAlreadyUsed($phone)) {
    $_SESSION['validation']['phone'] = "Пользователь с таким телефоном уже существует";
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['validation']['email'] = 'Email введен неверно';
}
elseif (isEmailAlreadyUsed($email)) {
    $_SESSION['validation']['email'] = "Пользователь с такой почтой уже существует";
}

if (empty($password)) {
    $_SESSION['validation']['password'] = 'Пароль введен неверно';
}

if (empty($repeat_password) || $password != $repeat_password) {
    $_SESSION['validation']['repeat_password'] = 'Пароль повторен неверно';
}

if (!empty($_SESSION['validation'])) {
    redirect("register.php");
}
else {
    $_SESSION['registration_input'] = [];
    insertUser([
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);
    $_SESSION['current_user'] = [
        'id' => findUserByEmail($email)['id'],
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
    ];
    redirect("inside.php");
}