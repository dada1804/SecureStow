<?php
if(isset($_POST['username'])&&isset($_POST['passwd'])){
    $password = $_POST['passwd'];
    $username=$_POST['username'];
    $security = $_POST['sec'];
    $db = new mysqli("localhost", "root", "", "secure_stow");
    $options = ['cost' => 12];
    $hash = password_hash($password, PASSWORD_DEFAULT, $options);

    if($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    $stmt = $db->prepare("INSERT INTO admin (username,passwd,securityans)  VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hash, $security);
    if($stmt->execute()) {
        echo '<script>alert("Registered successfully,redirecting you to fill your details"); setTimeout(function(){window.location.href = "customer.html";}, 1500);</script>';
        exit;
    } else {
        echo "Request could not be processed, Try again later" . $db->error;
    }
    $stmt->close();
    $db->close();
}

?>