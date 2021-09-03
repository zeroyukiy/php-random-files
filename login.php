<?php

session_start();

if (!empty($_POST["username"]) && !empty($_POST["password"])) {
    if ($_POST["username"] === "test123" && $_POST["password"] === "12345") {
        $_SESSION["name"] = $_POST["username"];
        $_SESSION["animal"] = "cat";
        $_SESSION["time"] = time();
        header("Location: index.php");
    } else {
        header("Location: index.php?login=error&err_message=wrong%20username%20or%20password");
    }
} else {
    header("Location: index.php?login=error&err_message=you need provide username and password");
}