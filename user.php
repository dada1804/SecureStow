<?php
session_start();
if (isset($_SESSION['user'])) {
  $db = new mysqli("localhost", "root", "", "secure_stow");
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
  $user = $_SESSION['user'];
  date_default_timezone_set("Asia/Kolkata");
  $h = date('G');
  if ($h >= 5 && $h <= 11) {
    $message = "Good morning!";
  } else if ($h >= 12 && $h <= 15) {
    $message = "Good afternoon!";
  } else if ($h >= 16 && $h < 20) {
    $message = "Good evening!";
  } else {
    $message = "Good night!";
  }
}
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h1 class="navbar-brand text-light"><b><?php
                                              $stmt = $db->prepare("SELECT * FROM customer WHERE Email_ID=?");
                                              $stmt->bind_param("s", $user);
                                              $stmt->execute();
                                              $sol = $stmt->get_result();
                                              if ($sol->num_rows > 0) {
                                                $recordd = $sol->fetch_assoc();
                                                if (isset($recordd)) {
                                                  echo '<b>Welcome, ' . $recordd['First_Name'] . '</b>';
                                                } else {
                                                  echo "Unable to access";
                                                }
                                              }
                                            
                                              ?></b></h1>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="info.php"><i class="fa fa-user"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="vehicle.html">Vehicle</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="house.html">House</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="logout.php"><i class="fa fa-sign-out"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </head>

  <body>

  </body>

  </html>
  <?php
  // session_start();
  //   if(isset($_SESSION['user'])){
  //     $db = new mysqli("localhost", "root", "", "secure_stow");
  //     $user=$_SESSION['user'];
  //     if($db->connect_error) {
  //       die("Connection failed: " . $db->connect_error);
  //     }
  $price=0 ;
  $stmt2 = $db->prepare("SELECT * FROM customer WHERE Email_ID=?");
  $stmt2->bind_param("s", $user);
  $stmt2->execute();
  $answer = $stmt2->get_result();
  $stmt3 = $db->prepare("SELECT * FROM household_items WHERE Email_ID=?");
  $stmt3->bind_param("s", $user);
  $stmt3->execute();
  $answer3 = $stmt3->get_result();
  $stmt4 = $db->prepare("SELECT * FROM vehicle_table WHERE Email_ID=?");
  $stmt4->bind_param("s", $user);
  $stmt4->execute();
  $answer4 = $stmt4->get_result();
  $stmt5 = $db->prepare("SELECT * FROM price WHERE Email_ID = ? ORDER BY Price DESC LIMIT 1");
 // $stmt5 = $db->prepare("SELECT * FROM price WHERE Email_ID=?");
  $stmt5->bind_param("s", $user);
  $stmt5->execute();
  $answer5 = $stmt5->get_result();
  $record = $answer->fetch_assoc();
  $record3 = $answer3->fetch_assoc();
  $record4 = $answer4->fetch_assoc();
  $record5 = $answer5->fetch_assoc();
  if ($answer3->num_rows > 0 || $answer4->num_rows > 0 || $answer5->num_rows > 0) {

    echo '<div style="text-align: center;font-size:2em;"><b>Hi Stower,</b>' . $message . '</div>';
    echo '<div style="text-align: center; font-size:1.75em;"><b>Here is your stowing status</b></div>';
    echo '<div style="text-align: center;"><br><br></div>';
    if (isset($record3)) { //&&isset($record3)&&isset($record4)){
      echo "<link rel='stylesheet' href='table.css'>";
      echo "<table>";
      echo "<tr>";
      echo "<th>Cust_ID</th>";
      echo "<th>No_of_large_items</th>";
      echo "<th>No_of_small_items</th>";
      //echo "<th>Duration_in_days</th>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>" . $record3['Cust_ID'] . "</td>";
      echo "<td>" . $record3['No_of_large_items'] . "</td>";
      echo "<td>" . $record3['No_of_small_items'] . "</td>";
     // echo "<td>" . $record3['Duration_in_days'] . "</td>";
      echo "</tr>";
      echo "</table>";
    }
    echo "<br>";
    if ($record4) {
      echo "<link rel='stylesheet' href='table.css'>";
      echo "<table>";
      echo "<tr>";
      echo "<th>Cust_ID</th>";
      echo "<th>Vehicle Number</th>";
      echo "<th>Engine Number</th>";
      echo "<th>Model</th>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>" . $record4['Cust_ID'] . "</td>";
      echo "<td>" . $record4['Vehicle_no'] . "</td>";
      echo "<td>" . $record4['Engine_no'] . "</td>";
      echo "<td>" . $record4['Model'] . "</td>";
      echo "</tr>";
      echo "</table>";
    }
    echo "<br>";

    if ($record5) {
      // if ($answer5->num_rows > 1) {
      //   while ($row = $answer5->fetch_assoc()) {
      //     $price = $row['Price'];
      //   }
      // }
      echo "<link rel='stylesheet' href='table.css'>";
      echo "<table>";
      echo "<tr>";
      echo "<th>Cust_ID</th>";
      echo "<th>Amount</th>";
      echo "<th>Duration in days</th>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>" . $record5['Cust_ID'] . "</td>";
      echo "<td>" . $record5['Price'] . "</td>";
      echo "<td>" . $record5['Duration_in_days'] . "</td>";
      echo "</tr>";
      echo "</table>";
      echo '<div>';

      echo "<a href='https://pmny.in/Trd5NA8rK1s7' style='width: 250px; background-color: #82AAE3; text-align: center; font-weight: 800; padding: 11px 0px; color: #205295; font-size: 18px; display: inline-block; text-decoration: none;float:right; font-family: Arial, Helvetica, sans-serif; border-radius: 1.2em;'>Pay Now</a>";

      echo '</div>';
    }
  } else {
    if ($record) {

      echo $message . ", stower" . "<br>";
      echo "<h3>Your customer ID is <b>" . $record['Cust_ID'] . "</b>, Please remember it for future reference</h3>" . "<br><br><br>";
      //echo '<b>Start stowing</b>';
    }
  }



  ?>