<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pws = $_POST["pwd"];


    try {
        require_once 'db.inc.php';
    } catch (PDOException $e) {
        die ("Query failed : " . $e->getMessage());
    }
} else {
    header("");
    die();
}