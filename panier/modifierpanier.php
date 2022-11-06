<?php
    session_start();
    $_SESSION["panier"][$_POST["id"]] += $_POST["val"];
?>