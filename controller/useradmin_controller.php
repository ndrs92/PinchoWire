<?php
include_once "../model/usuario.php";
/**
 * Created by PhpStorm.
 * User: ndrs
 * Date: 14/11/2015
 * Time: 16:28
 */

$_GET["action"]($_GET["idemail"]);

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$relpath = '../view/view_admin_usuarios.php'; 

header("Location: http://$host$uri/$relpath");

function delete_popular($idemail)
{
    $toDelete = Usuario::getByIdemail($idemail);
    $toDelete->deleteFromDatabase();

}

function delete_professional($idemail)
{
    $toDelete = Usuario::getByIdemail($idemail);
    $toDelete->deleteFromDatabase();

}

function delete_establishment($idemail)
{
    $toDelete = Usuario::getByIdemail($idemail);
    $toDelete->deleteFromDatabase();

}