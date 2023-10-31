<?php

require "connection.php";

if(isset($_GET["id"])){

    $wid = $_GET["id"];

    $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `id`= '".$wid."'");
    $watch_num = $watch_rs->num_rows;
    $watch_data = $watch_rs->fetch_assoc();

    if($watch_num == 0){
        echo ("Something went worng. Please try again leter");
    }else{
        Database::iud("INSERT INTO `recent`(`user_email`,`product_id`) VALUES ('".$watch_data["user_email"]."','".$watch_data["product_id"]."')");

        Database::iud("DELETE FROM `watchlist` WHERE `id`='".$wid."'");

        echo ("success");
    }
}else{
    echo ("Please select a product");
}
?>