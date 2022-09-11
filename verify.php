<?php
require 'core/config.php';

if(isset ($_GET ['vkey'])) {
    //Process Verification
    $vkey = $_GET['vkey'];
    
 $resultSet = mysql_query("SELECT v_key,verified  FROM circle WHERE verified= 0 AND v_key='$vkey' LIMIT 1");

//    if ($resultSet->num_rows == 1) {
        //Validate The email
        $update = mysql_query("UPDATE circle SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");
        
        if ($update) {
            echo "Your account has been verified. You my now login.";
        }else{
            echo "error";
        }    
    // }else{
    //     echo "This account invalid or already verified";
    // }
}else{
   die ("Something went wrong");
}

?>