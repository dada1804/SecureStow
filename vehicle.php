<?php
    session_start();
    if(isset($_POST)&&isset($_SESSION)){
        $vno=$_POST['vehicle-no'];
        $eno=$_POST['engine-no'];
        $cid=$_POST['cid'];
        $tf=$_POST['tf'];
        $model=$_POST['model'];
        $user=$_SESSION['user'];
        $_SESSION['two_or_four'] =$tf;
       // $dd=$_SESSION['dd'];//=$dd;
        //$large=$_SESSION['li'];//=$large;
      //  $small=$_SESSION['si'];//=$small;
        //$cid=$_SESSION['cid'];//=$cid;
        $db = new mysqli("localhost", "root", "", "secure_stow");
        if($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $stmt = $db->prepare("INSERT INTO vehicle_table (Cust_ID,Vehicle_no,Engine_no,Model,two_or_four_wheeler,Email_ID)  VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $cid, $vno, $eno, $model, $tf, $user);
        if($stmt->execute()){
        
            echo '<script>alert("Added successfully,redirecting you to your profile"); setTimeout(function(){window.location.href = "user.php";}, 1500);</script>';
        }else{
            echo "Error";
        }
        // $_SESSION['dd']=$dd;
        // $_SESSION['li']=$large;
        // $_SESSION['si']=$small;
        // $_SESSION['cid']=$cid;
        $db->close();

    }
?>