<?php

session_start();

require_once "Prova.php";

$c = new Prova(12);
var_dump((string)$c);
print_r("<pre>$c</pre>");

//$db = new SQLite3("test.db");
//
//$name = $_GET["value"];
//
//$stmt = $db->prepare("SELECT * FROM cars WHERE name = :name");
//$stmt->bindValue(":name", $name);
//
//$res = $stmt->execute();
//
//while ($row = $res->fetchArray()) {
//    echo "{$row['id']} => {$row['name']}: {$row['price']}" . "<br/>";
//}

//echo implode(",", ["pippo", "capra"]);
//echo join(",", ["pippo", "capra"]);

define('SOMETHING_AA', 10);


if (isset($_SESSION["name"]) && isset($_SESSION["animal"]) && isset($_SESSION["time"])) {
    echo session_id() . "<br/>";
    echo session_status() . "<br/>";
    echo $_SESSION["name"] . "<br/>";
    echo $_SESSION["animal"] . "<br/>";
    echo $_SESSION["time"] . "<br/>";
    echo "<a href='logout.php'>Logout</a> <br/>";
} else {
    echo "<h1>Login</h1>";
    if (isset($_GET["login"]) && $_GET["login"] === "error" && isset($_GET["err_message"])) {
        echo $_GET["err_message"] . "<br/>";
    }
    echo <<<EOD
    <form method="post" action="login.php" enctype="application/x-www-form-urlencoded">
        <input type="text" name="username" maxlength="20" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <input type="submit" value="Login">
    </form>
    EOD;
}

if(!empty($_SERVER["HTTPS"])) {
    $expire = time() + 1440;
    setcookie("food", "apple", $expire, "/", "localhost", true);
}

foreach ($_COOKIE as $k => $value) {
    echo "COOKIE: $k - $value <br/>";
}

//function foo(string $value): string | bool
//{
//    // Expected format: Surname, GivenNames
//    if (strpos($value, ", ") === false) return false;
//    list($surname, $givennames) = explode(", ", $value, 2);
//    $empty = (empty($surname) || empty($givennames));
//    $notstrings = (!is_string($surname) || !is_string($givennames));
//    if ($empty || $notstrings) {
//        return false;
//    } else {
//        return $value;
//    }
//}
//$var = filter_var("pippo, something", FILTER_CALLBACK, array('options' => 'foo'));
//var_dump($var);
