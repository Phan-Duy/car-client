<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./main.css">
   <title>DH Store</title>

</head>

<body>
   <div class="outer">
      <div id="logo-bg">
         <h1>2_DUY STORE</h1>
         <span class="tag">Company Slogan will come here</span>
      </div>
      <div id="business">
         <img width="603px" height="220px"
            src="./pngegg.png"
            alt="">
      </div>

      <!-- Menu ngang -->
      <div class="clear"></div>
      <div id="bg">
         <div class="toplinks">
            <a href="#">Homepage</a>
         </div>
         <div class="sap">|</div>
         <div class="toplinks">
            <a href="#">About us</a>
         </div>
         <div class="sap">|</div>
         <div class="toplinks">
            <a href="#">Products</a>
         </div>
         <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
         <div class="sap">|</div>
         <div class="toplinks">
            <a href="./car-management/list-car.php">Management</a>
         </div>
         <?php endif; ?>
         <?php if (!isset($_SESSION['is_login'])) : ?>
         <div class="sap">|</div>
         <div class="toplinks">
            <a href="./auth/login.php">Log in</a>
         </div>
         <div class="sap">|</div>
         <div class="toplinks">
            <a href="./auth/register.php">Sign up</a>
         </div>
         <?php else : ?>
         <div class="sap">|</div>
         <div class="toplinks">
            <a href="./functions/logout.php">Logout</a>
         </div>
         <div class="sap">|</div>
         <div class="toplinks" style="width: fit-content;">
            <span style="margin-left: 20px; font-weight: 500; color: blue;">Xin chào
               <strong><?php print_r($_SESSION['user']['fullName']) ?></strong></span>
         </div>
         <?php endif; ?>
      </div>
      <div class="clear"></div>
   </div>