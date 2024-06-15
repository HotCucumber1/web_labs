<?php
session_start();
$_SESSION = [];
session_destroy();

if (setcookie(session_name(), "", time() - 3600))
{
    header('Location: /');
}
else
{
    header("HTTP/1.1 401 Cookies not Found");
}