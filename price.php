<?php
session_start();
$db=new mysqli("localhost","root","","secure_stow");
if(isset($_SESSION)){
    $user = $_SESSION['user'];
    $dd   = $_SESSION['dd'];
    $li   = $_SESSION['li'];
    $si   = $_SESSION['si'];
    $cid  = $_SESSION['cid'];
    if(( $li <= 8 && $si <=12 &&$li!=0 && $si!=0)){
        $acrg="1 BHK";echo "You have been alloted a room of 1 BHK";
        if($dd>30)
        {
            $price=1099+(($dd-30)*45);
        }
        else{
            $price=1099;
        }
    }
    else if( $li>8 & $si>12 && $li!=0 && $si!=0){
        $acrg="2 BHK";
        echo "You have been alloted a room of 2 BHK";
        if($dd>30)
        {
            $price=2099+(($dd-30)*75);
        }
        else{
            $price=2099;
        }
    }
    else{
        echo "Please provide valid values for length and width of the room";
        exit();
    }
    $stmt = $db->prepare("INSERT into price (Cust_ID,Duration_in_days,Price,Email_ID) VALUES(?,?,?,?)");
    $stmt->bind_param("iiis",$cid,$dd, $price, $user);
    if($stmt->execute()){
        echo '<script>alert("Added successfully,redirecting you to your profile"); setTimeout(function(){window.location.href = "user.php";}, 1500);</script>';
        exit;
    }
    else{
        echo "Error: " . $stmt->error;
        exit();
    }
}
else{
    echo "Session not set";
    exit();
}

?>
