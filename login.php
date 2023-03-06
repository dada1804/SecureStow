
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login to Secure Stow</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">   
</head>
<body>
    <?php
    session_start();
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
            if ($password == "securestow") { 
                    header("Location:admin.php");
                    exit;
                
            }
        if (password_verify($password, $row['passwd'])) {
           
           $_SESSION['user']=$user;
          header("Location:user.php");
            exit;
        }
        else{
           echo "<script>alert('The password you entered is incorrect. Please try again.');</script>";
  
        } }
    
    else{
        echo "<script>alert('User doesnt exist, Please register');</script>";
    
    }
}

?>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="" method="post">
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="email" placeholder="Email" id="username" name="user" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>

        <button>Log In</button>
        <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>
        <div class="text-center fs-6">
           <div class="fp"> <a href="secure.html">Forgot Password?</a>&nbsp;&nbsp;  &nbsp;or&nbsp;  &nbsp;&nbsp;<a href="signup.html">SignUp</a>
            </div>
        </div>
    </form>
</body>
</html>