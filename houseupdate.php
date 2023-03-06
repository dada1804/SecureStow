<?php
session_start();
if (isset($_POST)) {
    $large = $_POST['large'];
    $small = $_POST['small'];
    $dd = $_POST['dd'];
    $user =$_SESSION ['user'];
//    // $price = $_SESSION['price'];
    $_SESSION['dd'] = $dd; 
    $_SESSION['dd']=$dd;
    $_SESSION['li']=$large;
    $_SESSION['si']=$small;
    $db = new mysqli("localhost", "root", "", "secure_stow");
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    $stmt = $db->prepare("UPDATE household_items SET No_of_large_items=? , No_of_small_items=?, Duration_in_days=?  WHERE Email_ID=?");
   // $stmt1 = $db->prepare("UPDATE price SET Price=?,Duration_in_days=? where Email_ID=?");
    $stmt->bind_param("iiis",$large,$small,$dd,$user);
   // $stmt1->bind_param("iis", $price, $dd, $user);
    if($stmt->execute()){
        echo '<script>alert("Details updated successfully, calculating the updated price. You will be redirected to the profile page..."); setTimeout(function(){window.location.href = "price.php";}, 1500);</script>';
    }else{
        echo "Error updating password,try again later";
    }

}
?>