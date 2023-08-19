<?php

session_start();

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
   header("Location: userlogin.php");
   exit();
}

$username = $_SESSION['user'];

require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php"; 

// Retrieve agencyid of the logged-in agency
$userid = null;
if ($stmt = $conn->prepare("SELECT userid, name FROM user WHERE username = ?")) {
   $stmt->bind_param("s", $username);
   $stmt->execute();
   $stmt->bind_result($userid, $name);
   $stmt->fetch();
   $stmt->close();
}

// Query to fetch available cars from the database
$sql = "SELECT * FROM cars";
$query = mysqli_query($conn, $sql);
$cars = mysqli_fetch_all($query, MYSQLI_ASSOC);

// Function to handle car rental
function rentCar($carId, $numDays, $startDate, $vehicleModel, $vehicleNo, $seatingCapacity, $rentPerDay, $userid, $username, $name,  $agencyid) {
   global $conn;

   // Check if the car is already booked
   $checkSql = "SELECT COUNT(*) FROM bookedcar WHERE carId = ?";
   $checkStmt = mysqli_prepare($conn, $checkSql);
   mysqli_stmt_bind_param($checkStmt, "i", $carId);
   mysqli_stmt_execute($checkStmt);
   mysqli_stmt_bind_result($checkStmt, $carCount);
   mysqli_stmt_fetch($checkStmt);
   mysqli_stmt_close($checkStmt);

   if ($carCount > 0) {
       return "Car is not available"; // Car is already booked
   }
   // Use prepared statements to prevent SQL injection
   $insertSql = "INSERT INTO bookedcar (carId, num_days, start_date, vehiclemodel, vehicleno, seatingcapacity, rentperday, userid, username, name, agencyid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
   $stmt = mysqli_prepare($conn, $insertSql);
   mysqli_stmt_bind_param($stmt, "iisssiiissi", $carId, $numDays, $startDate, $vehicleModel, $vehicleNo, $seatingCapacity, $rentPerDay, $userid, $username, $name,  $agencyid);

   if (mysqli_stmt_execute($stmt)) {
       return true; // Rental success
   } else {
       return false; // Rental failed
   }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rent'])) {
   if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {

      $agencyid = sanitize(trim($_POST['agencyid']));
      $carId = sanitize(trim($_POST['carId']));
      $numDays = $_POST['numDays'];
      $startDate = $_POST['startDate'];
      $selectedCar = $cars[array_search($carId, array_column($cars, 'carId'))];

      $rentalResult = rentCar($carId, $numDays, $startDate, $selectedCar['vehiclemodel'], $selectedCar['vehicleno'], $selectedCar['seatingcapacity'], $selectedCar['rentperday'], $userid, $username, $name,  $agencyid);

      if ($rentalResult === true) {
         echo "<script>alert('Your car is booked!!');</script>";
 
      } elseif ($rentalResult === "Car is not available") {
         echo "<script>alert('Car is not available for rental.');</script>";
      } else {
         echo "<script>alert('Car rental failed!! Try again.');</script>";
      }
   } else {
      // Redirect to login if not authenticated
      header("Location: userlogin.php");
      exit();
   }
}
?>

<div class="container">
   <?php include "includes/nav.php"; ?>
   <div style="margin-left:35px">
      <div class="jumbotron login col-lg-10 col-md-11 col-sm-12 col-xs-10">
         <p class="page-header" style="text-align: center"><b>Available Cars to Rent</b></p>
         <div class="container">
            <table class="table">
               <thead>
                  <tr>
                     <th>Vehicle Model</th>
                     <th>Vehicle Number</th>
                     <th>Seating Capacity</th>
                     <th>Rent Per Day</th>
                     <th>Car Id</th>
                     <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) { ?>
                     <th>Number of Days</th>
                     <th>Start Date</th>
                     <?php } ?>
                  </tr>
               </thead>


               <tbody>
                  <?php foreach ($cars as $car) { ?>
                  <tr>
                     <td><?php echo $car['vehiclemodel']; ?></td>
                     <td><?php echo $car['vehicleno']; ?></td>
                     <td><?php echo $car['seatingcapacity']; ?></td>
                     <td><?php echo $car['rentperday']; ?></td>
                     <td><?php echo $car['carId']; ?></td>


                     <?php
      // Fetch the agencyid associated with the current car
      $agencyid = $car['agencyid'];
      ?>
                     <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) { ?>
                        <form method="post">
                        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                        <input type="hidden" name="username" value="<?php echo $username; ?>">
                        <input type="hidden" name="agencyid" value="<?php echo  $agencyid; ?>">
                           <input type="hidden" name="carId" value="<?php echo $car['carId']; ?>">
                           <td>
                              <select class="form-control" name="numDays">
                                 <option value="1">1 Day</option>
                                 <option value="2">2 Days</option>
                                 <option value="3">3 Days</option>
                                 <option value="4">4 Days</option>
                                 <option value="5">5 Days</option>
                                 <option value="6">6 Days</option>
                                 <option value="7">7 Days</option>
                              </select>
                           </td>
                           <td><input type="date" class="form-control" name="startDate" required></td>
                           <td>
                              <button class="btn btn-success" type="submit" name="rent">Rent Car</button>
                           </td>
                        </form>
                     <?php } ?>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
