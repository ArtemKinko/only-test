<?php

const DB_HOST = 'localhost';
const DB_PORT = '5432';
const DB_NAME = 'only';
const DB_USER = 'postgres';
const DB_PASS = '';

function getPDO(): PDO
{
    return new \PDO(sprintf('pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s', DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASS));
}

function insertUser($values) {
    $query = "INSERT INTO user_info (name, phone, email, password_hash) VALUES (:name, :phone, :email, :password_hash)";
    $params = [
        ':name' => $values['name'],
        ':phone' => $values['phone'],
        ':email' => $values['email'],
        ':password_hash' => $values['password'],
    ];
    $stmt = getPDO()->prepare($query);
    $stmt->execute($params);
}

function updateUser($values) {
    $query = "UPDATE user_info SET name = :name, phone = :phone, email = :email, password_hash = :password_hash where id = :id";
    $params = [
        ':id' => $values['id'],
        ':name' => $values['name'],
        ':phone' => $values['phone'],
        ':email' => $values['email'],
        ':password_hash' => $values['password'],
    ];
    $stmt = getPDO()->prepare($query);
    $stmt->execute($params);
}

function findUserByEmail($email): array
{
    $query = "SELECT * FROM user_info WHERE email = :email";
    $stmt = getPDO()->prepare($query);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch();
        return [
            'id' => $result['id'],
            'name' => $result['name'],
            'phone' => $result['phone'],
            'email' => $result['email'],
            'password' => $result['password_hash'],
        ];
    }
    return [];
}

function findUserByPhone($phone): array
{
    $query = "SELECT * FROM user_info WHERE phone = :phone";
    $stmt = getPDO()->prepare($query);
    $stmt->bindValue(":phone", $phone);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetch();
        return [
            'id' => $result['id'],
            'name' => $result['name'],
            'phone' => $result['phone'],
            'email' => $result['email'],
            'password' => $result['password_hash'],
        ];
    }
    return [];
}

function isEmailAlreadyUsed($email): bool
{
    return !empty(findUserByEmail($email));
}

function isPhoneAlreadyUsed($phone): bool
{
    return !empty(findUserByPhone($phone));
}