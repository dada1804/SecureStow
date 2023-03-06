<?php
   session_start();
  $db=new mysqli("localhost","root","","secure_stow"); 
    if(isset($_SESSION)){
        $user = $_SESSION['user'];
        $cid=$_SESSION['cid'];
        $dd=$_SESSION['dd'];
        // $tf   = $_SESSION['tf'];
        // $li   = $_SESSION['li'];
        // $si   = $_SESSION['si'];
        // $cid  = $_SESSION['cid'];
      
    $price=1099;
    $stmt=$db->prepare("INSERT INTO price (Cust_ID,Duration_in_days,Price,Email_ID) VALUES (?,?,?,?)");
    $stmt->bind_param("iiis",$cid,$dd,$price,$user);
   
     if($stmt->execute()){
        echo '<script>alert("Price calculated for the vehicle, redirecting you to your profile");setTimeout{window.location.href="user.php",1500};</script>';
        exit;
     }
    }

>?