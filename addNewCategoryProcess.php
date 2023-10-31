<?php

session_start();
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["email"]) && isset($_POST["name"])){
    if($_SESSION["au"]["email"] == $_POST["email"]){

        $cname = $_POST["name"];
        $umail = $_POST["email"];

        $category_rs = Database::search("SELECT * FROM `category` WHERE `name` LIKE '%".$cname."%'");
        $category_num = $category_rs->num_rows;

        if($category_num == 0){

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$umail."'");


            //email code
            $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ravinduchamika2001@gmail.com';
        $mail->Password = 'folybdfpldaljyvd';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('ravinduchamika2001@gmail.com', 'Admin Verification');
        $mail->addReplyTo('ravinduchamika2001@gmail.com', 'Admin Verification');
        $mail->addAddress($umail);
        $mail->isHTML(true);
        $mail->Subject = 'eShop Admin Verification Code for Add New Category';
        $bodyContent = '<h1 style="color:blue">Your Verification code is '.$code.'</h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo 'Verification code sending faild';
        }else {
            echo 'Success';
        }

         }else{
             echo ("This category Already Exists");
         }
     }else{
         echo ("Invalid User");
     }
 }else{
     echo ("Something Missing");
 }

?>