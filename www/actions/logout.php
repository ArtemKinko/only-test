<?php

session_start();
require_once __DIR__ . '/../utils/redirect.php';

$_SESSION['current_user'] = [];

redirect("login.php");