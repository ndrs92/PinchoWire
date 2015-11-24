<?php

if(!isset($_SESSION)) session_start();
    print_r($_SESSION);
    if(isset($_SESSION["alert"]["error"])) {
        echo "<script>alertify.error('". $_SESSION["alert"]["error"]."');</script>";
    }
    if(isset($_SESSION["alert"]["success"])) {
        echo "<script>alertify.success('". $_SESSION["alert"]["success"] ."');</script>";
    }
    unset($_SESSION["alert"]);
?>