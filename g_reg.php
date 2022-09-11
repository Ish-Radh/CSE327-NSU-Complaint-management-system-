


<?php
require 'g_db_connection.php';
require 'core/config.php';
  error_reporting(0);

if(!isset($_SESSION['login_id'])){
    header('Location: g_login.php');
    exit;
}

$id = $_SESSION['login_id'];

$get_user = mysqli_query($db_connection, "SELECT * FROM `g_users` WHERE `google_id`='$id'");

if(mysqli_num_rows($get_user) > 0){
    $user = mysqli_fetch_assoc($get_user);
}
else{
    // header('Location: g_logout.php');
    exit;
}

if(empty($_POST)===false){
    $name = $user['name'];
    $nsu_id =  mysql_real_escape_string($_POST['nsu_id']);
    $phone =  mysql_real_escape_string($_POST['phone']);
    $email =  $user['email'];
    $password =  mysql_real_escape_string($_POST['password']);
    $imagename = $user['profile_image']; 
    $vkey = md5(time().$name);


    if(empty($name) || empty($nsu_id)|| empty($phone) || empty($email) ||empty($password) ||empty($imagename)||empty($vkey)){
        $message = "Please insert data";
    }else{
      mysql_query("INSERT INTO `circle` VALUES ('0','$name','$nsu_id','$phone','$email','$password','$imagename','$vkey',0,NOW())") or die(mysql_error());
      $message = "Your account has been Registerd";
      

      $to =$email;
      $subject = "Email Verification";
      $message = "<a href='http://localhost/ComplaintMgSystem-PHP/verify.php?vkey=$vkey'>Register Account</a>";
      $headers = "Form: nsuclsproject@gmail.com \r\n";
      $headers .= "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      mail($to,$subject,$message,$headers);
      session_start();
	    session_unset();
	    session_destroy();
      header('location:Thanks.php');
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <title><?php echo $user['name']; ?></title> -->
    <title>NSU CLS</title>
    <link rel="shortcut icon" href="files/img/ico.ico">
    <link rel="stylesheet" href="files/css/bootstrap.css">
    <link rel="stylesheet" href="files/css/custom.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7ff;
            /* padding: 10px;
            margin: 0; */
        }
        ._container{
            max-width: 400px;
            background-color: #ffffff;
            padding: 20px;
            margin: 0 auto;
            border: 1px solid #cccccc;
            border-radius: 2px;
        }

        ._img{
            overflow: hidden;
            width: 100px;
            height: 100px;
            margin: 0 auto;
            border-radius: 50%;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        ._img > img{
            width: 100px;
            min-height: 100px;
        }
        ._info{
            text-align: center;
        }
        ._info h1{
            margin:10px 0;
            text-transform: capitalize;
        }
        ._info p{
            color: #555555;
        }
        ._info a{
            display: inline-block;
            background-color: #E53E3E;
            color: #fff;
            text-decoration: none;
            padding:5px 10px;
            border-radius: 2px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
        td{
      padding:10px;
      border-top: 0px solid #eee;
      border-bottom: 0px solid #eee!important;
      padding-left: 0px;
      color:#0ea798;
    }
    input,button.log{width: 450px;}
    </style>
</head>
<body>

  
  

    <div class="animated fadeIn">


    <div class="cover user text-center">
      <img src="files/img/logo.png" alt="logo">
      <br>
      <h2>Sign up</h2>
    </div>
   
    <!-- <div class="_container">
        <div class="_img">
            <img src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>">
        </div>
        <div class="_info">
            <h1><?php echo $user['name']; ?></h1>
            <p><?php echo $user['email']; ?></p>
            <a href="g_logout.php">Logout</a>
        </div>
    </div> -->
   
    
    <div class="padd">
        <div class="col-lg-12 text-center">
              <form class="" method="post" enctype="multipart/form-data" autocomplete="off">
                <!-- <input type="text" name="name" placeholder="Your Name">
                <br><br>
                <input type="text" name="nsu_id" placeholder="Your ID">
                <br><br>
                <input type="text" name="phone" placeholder="Your Phone Number">
                <br><br> 
                <input type="text" name="email" placeholder="Your Email">
                <br><br>
                <input type="password" name="password" placeholder="password">
                <br><br> -->
                


                <table>
                <tr>
                  <td class="text">Name</td>
                  <td class="text"><div class="dis_b"><?php echo $user['name']; ?></div></td>
                </tr>
                <tr>
                  <td class="text">NSU ID *</td>
                  <td class="text"><input type="text" name="nsu_id" placeholder="Your ID"></td>
                </tr>
                <tr>
                  <td class="text">Your Contact Number *</td>
                  <td class="text"><input type="text" name="phone" placeholder="Your Phone Number"></td>
                  <!-- <td><input type = "text" name = "phoneno" maxlength=10 placeholder = "Your Phone number">  </td> -->
                </tr>
                <!-- <tr>
                  <td class="text">Your User ID</td>
                  <td class="text"><div class="dis_b"><?php echo $alpha.$id;  $user_id = $id;?></div></td>
                </tr> -->
                <tr>
                  <td class="text">Your Your Email ID</td>
                  <td class="text"><div class="dis_b"><?php echo $user['email'];?></div></td>
                </tr>
                
                <tr>
                  <td class="text">Password *</td>
                  <td class="text"><input type="password" name="password" placeholder="password"></td>
                  <!-- <td><input type = "text" name = "phoneno" maxlength=10 placeholder = "Your Phone number">  </td> -->
                </tr>

                <tr>
                
                  <td class="text"><img src="<?php $user['profile_image']; ?>" ></td>
                  <!-- <td><input type = "text" name = "phoneno" maxlength=10 placeholder = "Your Phone number">  </td> -->
                </tr>
                </table>

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