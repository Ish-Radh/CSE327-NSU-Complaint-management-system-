<?php
  require 'core/config.php';
  error_reporting(0);


  if(empty($_POST)===false){
    $name = mysql_real_escape_string($_POST['name']);
    $nsu_id =  mysql_real_escape_string($_POST['nsu_id']);
    $phone =  mysql_real_escape_string($_POST['phone']);
    $email =  mysql_real_escape_string($_POST['email']);
    $password =  mysql_real_escape_string($_POST['password']);
    $imagename = $_FILES['image']['name'];
    $tmpname = $_FILES['image']['tmp_name'];
    $uploc = 'files\images'.$imagename;
    
    $vkey = md5(time().$name);


    if(empty($name) || empty($nsu_id)|| empty($phone) || empty($email) ||empty($password) ||empty($imagename)||empty($vkey)){

    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL) === true) {
      $message = "It's not a valid email address";
    }else{
      mysql_query("INSERT INTO `circle` VALUES ('0','$name','$nsu_id','$phone','$email','$password','$imagename','$vkey',0,NOW())") or die(mysql_error());
      $message = "Your account has been Registerd";
      move_uploaded_file($tmpname,$uploc);  

      $to =$email;
      $subject = "Email Verification";
      $message = "<a href='http://localhost/ComplaintMgSystem-PHP/verify.php?vkey=$vkey'>Register Account</a>";
      $headers = "Form: nsuclsproject@gmail.com \r\n";
      $headers .= "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      mail($to,$subject,$message,$headers);
      header('location:Thanks.php');
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
  <body>

    <div class="animated fadeIn">


    <div class="cover user text-center">
      <img src="files/img/logo.png" alt="logo">
      <br>
      <h2>Sign up</h2>
    </div>

      <div class="padd">
        <div class="col-lg-12 text-center">
              <form class="" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="text" name="name" placeholder="Your Name">
                <br><br>
                <input type="text" name="nsu_id" placeholder="Your ID">
                <br><br>
                <input type="text" name="phone" placeholder="Your Phone Number">
                <br><br> 
                <input type="text" name="email" placeholder="Your Email">
                <br><br>
                <input type="password" name="password" placeholder="password">
                <br><br>
                <input type="file" name="image" >
                <br><br>
                <?php echo "<p>".$message."</p>"; ?>
                <br><br>
               
                <button type="submit" class="log">Sign up</button>
                <br><br>
              </form>
              <br>Already have an acccount ? <a href="index.php">Login  </a>
              
        </div>
      </div>
      <div class="links">
        <a href="index.php">Home </a>
      </div>
  </div>

    <script src="files/js/jquery.js"></script>
    <script src="files/js/bootstrap.min.js"></script>
    <script src="files/js/script.js"></script>

  </body>
</html>
                            