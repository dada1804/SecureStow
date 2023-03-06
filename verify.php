<?php
    if(isset($_POST['user'])&&isset($_POST['password'])){
        $user=$_POST['user'];
        $password=$_POST['password'];
        $options = ['cost' => 12];
        $hash = password_hash($password, PASSWORD_DEFAULT, $options);
        $db = new mysqli("localhost", "root", "", "secure_stow");
        if($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $stmt = $db->prepare("SELECT passwd FROM admin WHERE username=?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['passwd'])) {
            echo "Welcome " . $user;
        } else {
        echo "Incorrect password";
        }
        } else {
        echo "Username not found";
        }

    }

?>