<?php
include_once "../model/usuario.php";
/**
 * Created by PhpStorm.
 * User: ndrs
 * Date: 14/11/2015
 * Time: 16:28
 */
session_start();
if(get_class($_SESSION["user"])!="Administrador"){
    header("Location: ../view/403.php");
    exit;
}

$_GET["action"]($_GET["idemail"]);

function delete_popular($idemail)
{
    $toDelete = Usuario::getByIdemail($idemail);
    $toDelete->deleteFromDatabase();
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $relpath = '../view/view_admin_usuarios.php';

    header("Location: http://$host$uri/$relpath");

}

function edit($idemail)
{
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $relpath = '../view/profile.php?idemail='.$idemail;
    header("Location: http://$host$uri/$relpath");

}

function delete_professional($idemail)
{
    $toDelete = Usuario::getByIdemail($idemail);
    $toDelete->deleteFromDatabase();
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $relpath = '../view/view_admin_usuarios.php';

    header("Location: http://$host$uri/$relpath");

}

function delete_establishment($idemail)
{
    $toDelete = Usuario::getByIdemail($idemail);
    $toDelete->deleteFromDatabase();
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $relpath = '../view/view_admin_usuarios.php';

    header("Location: http://$host$uri/$relpath");

}