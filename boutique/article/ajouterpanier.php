<?php
    session_start();
    $_SESSION["panier"][$_POST["id"]] = 1;
?>