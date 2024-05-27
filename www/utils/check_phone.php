<?php

function check_phone($phone)
{
    return preg_match("/^[+7]\d{11}$/", $phone);
}