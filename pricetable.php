<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acreage alloted</title>
    <link rel="stylesheet" href="pricetable.css">
</head>
<body>
   <?php
   $db=new mysqli("localhost","root","","secure_stow");
    session_start();
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $dd   = $_SESSION['dd'];
        $li   = $_SESSION['li'];
        $si   = $_SESSION['si'];
        $cid  = $_SESSION['cid'];
      
    }
    if( $li <= 8 && $si <=12 &&$li!=0 && $si!=0){
    $acrg="1 BHK";echo "You have been alloted a room of 1 BHK"
     if($dd>30)
     {
        $price1=1099+(($dd-30)*45);
     }
     else{
        $price1=1099;
     }
     $stmt = $db->prepare("Insert into price values ($cid,$dd,$price1=?,$user)");
     $stmt->bind_param("s", $price1);
     if(stmt->execute()){
        header("Location:user.php");exit;
     }
    }
    else if( $li>8 & $si>12 && $li!=0 && $si!=0){
        $acrg="2 BHK";
        echo "You have been alloted a room of 2 BHK"
     if($dd>30)
     {
        $price2=2099+(($dd-30)*75);
     }
     else{
        $price2=2099;
     }
     $stmt = $db->prepare("Insert into price values ($cid,$dd,$price2=?,$user)");
     $stmt->bind_param("s", $price2);
     if(stmt->execute()){
        header("Location:user.php");exit;
     }
    }
?>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Cust_ID</th>
            <th scope="col">Acreage Alloted</th>
            <th scope="col">Duration(<small>in days</small>)</th>
            <th scope="col">Price</th>
            <th scope="col">Email ID</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>1 BHK</td>
            <td>40</td>
            <td>1099/-</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Car</td>
            <td>78</td>
            <td>999/-</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>2 BHK</td>
            <td>85</td>
            <td>2099/-</td>
          </tr>
        </tbody>
      </table>
      <div class="butt"> <a href='https://pmny.in/Trd5NA8rK1s7' ><button class="btn btn-outline-light btn-block ">Book Now </button></a> </div>
</body>
</html>