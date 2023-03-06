<?php
session_start();
    if(isset($_SESSION)){
        $user=$_SESSION['user'];
        $db = new mysqli("localhost", "root", "", "secure_stow");
        if($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
        }
        $stmt = $db->prepare("SELECT * FROM customer WHERE Email_ID=?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows>0)
        {
            $record=$result->fetch_assoc();
            if(isset($record)){
                echo "<link rel='stylesheet' href='table.css'>";
                echo "<table>";
                echo "<tr>";
                echo "<th>Customer ID</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Primary Contact</th>";
                echo "<th>Secondary Contact</th>";
                echo "<th>Email ID</th>";
                echo "<th>Nominee Name</th>";
                echo "<th>Realationship</th>";
                echo "<th>Nominee Contact</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>" . $record['Cust_ID'] . "</td>";
                echo "<td>" . $record['First_Name'] . "</td>";
                echo "<td>" . $record['Last_Name'] . "</td>";
                echo "<td>" . $record['Primary_Contact'] . "</td>";
                echo "<td>" . $record['Secondary_Contact'] . "</td>";
                echo "<td>" . $record['Email_ID'] . "</td>";
                echo "<td>" . $record['Nominee_Name'] . "</td>";
                echo "<td>" . $record['Relationship'] . "</td>";
                echo "<td>" . $record['Nominee_Contact'] . "</td>";
                echo "</tr>";
                echo "</table>";
            }
        }
    echo "<br><br>";
    echo '<p><a href=customerupdate.html><button class="update">Update Details</button></a></p>';
    echo '<p><a href=user.php class="update1"><button class="update2">Your Profile</button></a></p>';
    echo '<p><a href=houseupdate.html class="update1"><button class="update2">Extend the duration</button></a></p>';
    }
?>