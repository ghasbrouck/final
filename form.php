<?php

ini_set("display_errors", "On");

$email = $_POST["email"];
$fName = $_POST["fName"];
$lName = $_POST["lName"];
$num = $_POST["num"];
$addy = $_POST["addy"];

$host = "localhost";
$dbname = "my_first_database";
$username = "root";
$password = "root";

$connection = mysqli_connect($host, $username, $password, $dbname);

if(mysqli_connect_errno()) {
    die("Connnection failed :(" . mysqli_connect_error());
}

$sql = "INSERT INTO customers (email, fName, lName, num, addy)
    VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($connection);

if(! mysqli_stmt_prepare($stmt, $sql) ){
    die(mysqli_error($connection));
}

mysqli_stmt_bind_param($stmt, "sssis", $email, $fName, $lName, $num, $addy);


if(mysqli_stmt_execute($stmt)) {
    echo "Data has been sent to database :)";
    header("Location: index.html");
} else {
    if(mysqli_stmt_errno($stmt) === 1062) {
        die("It appears there is already a customer with that email address. Perhaps it is you hahahaha");
    } else {
        die("Error: " . mysqli_stmt_errno($stmt) . " Make sure to yell at the creator of this website because he failed hahaha");
    }
}
