<?php
session_start();
if (isset($_POST['email']) && isset($_POST['ans'])) {
    $ans = $_POST['ans'];
    $email = $_POST['email'];
    $db = new mysqli("localhost", "root", "", "secure_stow");
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    $stmt1 = $db->prepare("SELECT securityans FROM admin WHERE username = ?");
    $stmt1->bind_param("s", $email);
    if($stmt1->execute()) {
        $stmt1->bind_result($securityans);
        if($stmt1->fetch()){
            if($ans!=$securityans) {
                echo '<script>alert("Authentication failed..Try again..");setTimeout(function(){window.location.href = "secure.html";}, 1500);</script>';
            }
            else{
                echo '<script>alert("Authentication success..Redirecting you to update your password");setTimeout(function(){window.location.href = "password.html";}, 1500);</script>';
            }
        } else {
            echo '<script>alert("Invalid Email..Try again..");setTimeout(function(){window.location.href = "secure.html";}, 1500);</script>';
        }
    } else {
        echo '<script>alert("Error occured..Try again later.");setTimeout(function(){window.location.href = "secure.html";}, 1500);</script>';
    }
    $_SESSION['user'] = $email;
}
?>
