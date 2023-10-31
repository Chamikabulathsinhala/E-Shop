<?php

session_start();
require "connection.php";

$msg_txt = $_POST["t"];
$receiver = $_POST["r"];

if (empty($msg_txt)) {

    echo ("Empty Message");
} else {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $sender;

    if (isset($_SESSION["u"])) {

        $sender = $_SESSION["u"]["email"];
    } else if (isset($_SESSION["au"])) {

        $sender = $_SESSION["au"]["email"];
    }

    if (empty($receiver)) {

        Database::iud("INSERT INTO `admin_chat` (`content`,`date_time`,`status`,`admin_email`,`user_email`) VALUES ('" . $msg_txt . "','" . $date . "','0','" . $sender . "','" . $receiver . "')");

        echo ("success1");
    } else {

        if (isset($_SESSION["u"]) && !isset($_SESSION["au"])) {

            if ($sender == $_SESSION["u"]["email"]) {

                Database::iud("INSERT INTO `admin_chat` (`content`,`date_time`,`status`,`user_email`,`admin_email`) VALUES ('" . $msg_txt . "','" . $date . "','1','" . $sender . "','vidubulathsinhala@gmail.com')");

                echo ("1");
            }
        } else if (isset($_SESSION["au"]) && !isset($_SESSION["u"])) {

            if ($sender == $_SESSION["au"]["email"]) {

                Database::iud("INSERT INTO `admin_chat` (`content`,`date_time`,`status`,`admin_email`,`user_email`) VALUES ('" . $msg_txt . "','" . $date . "','2','vidubulathsinhala@gmail.com','" . $receiver . "')");

                echo ("2");
            }
        }
    }
}
