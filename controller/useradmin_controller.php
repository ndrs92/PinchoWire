<?php
include_once "../model/usuario.php";

$_GET["action"]($_GET["idemail"]);

function edit($idemail)
{
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $relpath = '../view/profile.php?idemail='.$idemail;
    header("Location: http://$host$uri/$relpath");

}

function ban($idemail)
{
    $toBan = Usuario::getByIdemail($idemail);
    $toBan->editBanFromDatabase("1");
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $relpath = '../view/view_admin_usuarios.php';

    header("Location: http://$host$uri/$relpath");

}

function unban($idemail)
{
    $toUnBan = Usuario::getByIdemail($idemail);
    $toUnBan->editBanFromDatabase("0");
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $relpath = '../view/view_admin_usuarios.php';

    header("Location: http://$host$uri/$relpath");

}
