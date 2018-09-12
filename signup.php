<?php
    include("db.php");

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    InserirUsuario($name, $email, $password);
?>