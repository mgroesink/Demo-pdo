<?php 

    $server = "localhost";
    $database = "customers";
    $user = "Demo";
    $password = "Demo!2022";

    $pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);