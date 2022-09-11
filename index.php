<?php

  
  require 'core/session.php';
  require 'core/config.php';
  require 'core/redirect.php';

  if(isset($_SESSION['username'])===true){
      header("location:profile.php");
  }

  $message="";

  if(empty($_POST)===false){
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
      if(empty($email) || empty($password)){
            header('Location:index.php');
      }else{
          $query1=mysql_query("SELECT * FROM `circle` WHERE id AND email='$email' and password='$password'") or die(mysql_error());
          
          if(mysql_num_rows($query1)>0){
              $_SESSION['email'] = $_REQUEST['email'];
              if($_REQUEST['verified' == 1]){
              header('Location:profile.php');
              }
              else{
                $message="Not Verified";
              }
          }else{
            $message="Your username or password is incorrect";
          }
        }
    }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NSU CLS</title>
    <link rel="shortcut icon" href="files/img/ico.ico">
    <link rel="stylesheet" href="files/css/bootstrap.css">
    <link rel="stylesheet" href="files/css/custom.css">
  </head>
  <body >

    <div class="animated fadeIn">


    <div class="cover user text-center">
      <img src="files/img/logo.png" alt="logo">

      <br>
      <h2>USER LOGIN</h2>
    </div>



      <div class="padd">

        <div class="col-lg-12 text-center">
              <form class="" method="post" autocomplete="off">
                <label for="username"></label>
                <input type="email" name="email" placeholder="Email" id="email">
                <br><br>
                <label for="password"></label>
                <input type="password" name="password" placeholder="Password" id="pass">
                <br><br>
                <button type="submit" class="log">Login</button>
                <br><br>
                <span class="red"><?php echo $message; ?></span>
              </form>
              <br>
                Don't have an acccount ? <a href="signup.php">Sign Up  </a>
                <br>
              <br>
              <a href="<?php require 'g_login.php';
               echo $client->createAuthUrl(); 
               ?>" class="google btn"> Register with <b>Google</b></a>

        </div>
      </div>

      <div class="links">
        <a href="dummy-login.php">Faculty</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin-login.php">Admin </a>
      </div>

    </div>
    <?php
    include 'footer.php';
    include 'core/jsscript.php';
    ?>


  </body>
</html>
