<?php
include_once "../model/usuario.php";
/**
 * Created by PhpStorm.
 * User: ndrs
 * Date: 14/11/2015
 * Time: 16:28
 */

$_GET["action"]($_GET["idemail"]);

function edit($idemail)
{
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $relpath = '../view/profile.php?idemail='.$idemail;
    header("Location: http://$host$uri/$relpath");

}

function ban_popular($idemail)
{
    $toBan = Usuario::getByIdemail($idemail);
    $toBan->banFromDatabase();
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $relpath = '../view/view_admin_usuarios.php';

    header("Location: http://$host$uri/$relpath");

}

function ban_professional($idemail)
{
    $toBan = Usuario::getByIdemail($idemail);
    $toBan->banFromDatabase();
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $relpath = '../view/view_admin_usuarios.php';

    header("Location: http://$host$uri/$relpath");

}

function ban_establishment($idemail)
{
    $toBan = Usuario::getByIdemail($idemail);
    $toBan->banFromDatabase();
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $relpath = '../view/view_admin_usuarios.php';

    header("Location: http://$host$uri/$relpath");

}

function unban($idemail)
{
    $toUnBan = Usuario::getByIdemail($idemail);
    $toUnBan->unbanFromDatabase();
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $relpath = '../view/view_admin_usuarios.php';

    header("Location: http://$host$uri/$relpath");

}


/* Borrar?? */
function unban_professional($idemail)
{
    $toUnBan = Usuario::getByIdemail($idemail);
    $toUnBan->banFromDatabase();
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $relpath = '../view/view_admin_usuarios.php';

    header("Location: http://$host$uri/$relpath");

}

function unban_establishment($idemail)
{
    $toBan = Usuario::getByIdemail($idemail);
    $toBan->banFromDatabase();
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $relpath = '../view/view_admin_usuarios.php';

    header("Location: http://$host$uri/$relpath");

}