<?php
session_start();
if (isset($_POST)) {
    $db = new mysqli("localhost", "root", "", "secure_stow");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    echo '<link rel=stylesheet href=table.css>';
    $new = $_POST['newpass'];
    $password = $_POST['password'];
    $user = $_SESSION['user'];
    
    $options = ['cost' => 12];
   
    if($password != $new){
        echo '<script>alert("Passwords do not match, Try again..");setTimeout(function(){window.location.href = "password.html";}, 1500);</script>';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT, $options);
        $stmt = $db->prepare("UPDATE admin SET passwd=?  WHERE username=?");
        $stmt->bind_param("ss", $hash, $user);
        if ($stmt->execute()) {
            echo '<script>alert("Password updated successfully!!,redirecting you to login page"); setTimeout(function(){window.location.href = "login.php";}, 1500);</script>';
        } else {
            echo "Error updating password,try again later";
        }
    }
}
?>