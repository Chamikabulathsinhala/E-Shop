<?php
session_start();
require "connection.php";

if(isset($_SESSION["u"])){
    
    $email = $_SESSION["u"]["email"];
    $type = $_POST["t"];
    $pid = $_POST["pid"];
    $feedback = $_POST["feed"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `feedback`(`type`,`feedback`,`date`,`product_id`,`user_email`) VALUES
    ('".$type."','".$feedback."','".$date."','".$pid."','".$email."')");

    echo "1";

}
?>