<?php
    require 'core/session.php';
    require 'core/config.php';
    include 'core/user_key.php';
    //for session
    $session=$_SESSION['email'];
    $ref = rand (3858558,100000);$error = "";$message = "";$alpha="N S U ";
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
    <style media="screen">
    table{border: 0px;}
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
    <div class="cover user text-center" style="height:120px;">
      <br>
      <h2>Add Complaints</h2>
    </div>
    <?php require 'nav-profile.php'; ?>
    <div class="animated fadeIn">
      <div class="padd">
        <div class="col-lg-12 text-center">
          <?php
            $query1=mysql_query("SELECT * FROM `circle` WHERE email LIKE '%$session%'");
            while( $arry=mysql_fetch_array($query1) ) {
              $id=$arry['id'];
              $name=$arry['name'];
              $nsu_id=$arry['nsu_id'];
              $email = $arry['email'];
              $phoneno = $arry['phone'];
                 }
            $query2=mysql_query("SELECT * FROM `dummy`");
             
                       
                   if(empty($_POST)===false){
                     
                     $subject = mysql_real_escape_string($_POST['subject']);
                     $complain = mysql_real_escape_string($_POST['complain']);
                    
                     if(empty($subject) || empty($complain) ){
                     }elseif (!preg_match("/^[0-9]*$/",$phoneno)) {
                       $error = "Invalid Phone Number";
                     }else{
                       mysql_query("INSERT INTO `cmp_log` VALUES ('0','$id','$name','$nsu_id','$email','$phoneno','$name1','$subject','$complain','$ref')") or die(mysql_error());
                       move_uploaded_file($tmpname,$uploc); 
                       $message = "Your Complain has been Registerd";
                       }
                   }
              ?>
          <form class="" method="post" autocomplete="off">
            <div class="container">
              <div class="panel panel-default">
                  <div class="panel-body">
                      <h2>Your Refference no : &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ref;
                      echo"<p><span class='error'>".$error."</p></span>";
                      echo "<p><span class='message'>".$message."</p></span>";
                      ?></h2>
                  </div>
              </div>
              <table>
                <tr>
                  <td class="text-left">Your Refference no</td>
                  <td class="text-left"><div class="dis_b"><?php echo $ref;  ?></div></td>
                </tr>
                <tr>
                  <td class="text-left">Your ID</td>
                  <td class="text-left"><div class="dis_b"><?php echo $nsu_id;?></div></td>
                </tr>
                <tr>
                  <td class="text-left">Your User ID</td>
                  <td class="text-left"><div class="dis_b"><?php echo $alpha.$id;  $user_id = $id;?></div></td>
                </tr>
                <tr>
                  <td class="text-left">Your Your Email ID</td>
                  <td class="text-left"><div class="dis_b"><?php echo $email;?></div></td>
                </tr>
                <tr>
                  <td class="text-left">Your Contact Number *</td>
                  <td class="text-left"><div class="dis_b"><?php echo $phoneno;?></div></td>
                  <!-- <td><input type = "text" name = "phoneno" maxlength=10 placeholder = "Your Phone number">  </td> -->
                </tr>
                <!-- New add -->

                <tr>
                  <td class="text-left">Complaint Against *</td> 
                  <td>
                    <select class="select" multiple data-mdb-clear-button="true">
                  <option disabled selected>-- Select Reviewer --</option>
                  <?php 

                      while( $arry1=mysql_fetch_array($query2) ) {
                                        
                        $name1=$arry1['name'];

                        echo "<option value='". $name1 ."'>" .$name1 ."</option>";
                      }
                        
  
                          

                    // $query2=mysql_query("SELECT name FROM `dummy`");
                    // while($cmp_against = mysqli_fetch_array($query2)){
                    //         echo "<option value='". $cmp_against['name'] ."'>" .$cmp_against['name'] ."</option>";  // displaying data in option menu
                    //     }	
                  ?>
                 
                        <!-- <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                        <option value="5">Five</option> -->
                      </select>
                  </td>
                </tr>

                <!-- New add -->
                <tr>
                  <td class="text-left">Your Subject *</td>
                  <td><input type="text" name = "subject" placeholder = "Subject"></td>
                </tr>
                <tr>
                  <td class="text-left">Your Complain *</td>
                  <td><textarea name="complain" rows="8" cols="80" placeholder="Your complain"></textarea></td>
                </tr>
                <tr><td>
                <br><br>
                
                <br><br>
                </td>
                <td></td></tr>
                
                <tr>
                  <td></td>
                  <td><button type="submit" class="log">Submit</button></td>
                </tr>
              </table>
            </div>
          </form>
        </div>
      </div>
    </div>
      <footer>
            <br><br>&copy <?php echo date("Y"); ?> <?php echo $web_name; ?>
      </footer>
    <script src="files/js/jquery.js"></script>
    <script src="files/js/bootstrap.min.js"></script>
    <script src="files/js/script.js"></script>
  </body>
</html>
