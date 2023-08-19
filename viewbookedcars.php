<?php
session_start();

require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";

$agencyname = $_SESSION['agency'];

// Retrieve agencyid of the logged-in agency
$agencyid = null;
if ($stmt = $conn->prepare("SELECT agencyid, name FROM agency WHERE agencyname = ?")) {
    $stmt->bind_param("s", $agencyname); // Use $agencyname instead of $name
    $stmt->execute();
    $stmt->bind_result($agencyid, $agencyname); // Add $agencyname here
    $stmt->fetch();
    $stmt->close();
}



// Assuming your SQL query to fetch booked car details
$sql =  "
select * from bookedcar where agencyid='$agencyid'
";
$query = mysqli_query($conn, $sql);
$bookedCars = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="container">
   <?php include "includes/nav.php"; ?>
   <div class="container col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0" style="margin-top: 20px">
      <div class="jumbotron login col-lg-10 col-md-11 col-sm-12 col-xs-10">
         <p class="page-header" style="text-align: center"><b>View Booked Cars</b></p>
         
         <div class="container">
            <table class="table">
               <thead>
                  <tr>
                     <th>User ID</th>
                     <th>Name</th>
                     <th>Car ID</th>
                     <th>Number of Days</th>
                     <th>Start Date</th>
                     <th>Vehicle Model</th>
                     <th>Vehicle Number</th>
                     <th>Seating Capacity</th>
                     <th>Rent per Day</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($bookedCars as $car) { ?>
                  <tr>
                     <td><?php echo $car['userid']; ?></td>
                     <td><?php echo $car['name']; ?></td>
                     <td><?php echo $car['carId']; ?></td>
                     <td><?php echo $car['num_days']; ?></td>
                     <td><?php echo $car['start_date']; ?></td>
                     <td><?php echo $car['vehiclemodel']; ?></td>
                     <td><?php echo $car['vehicleno']; ?></td>
                     <td><?php echo $car['seatingcapacity']; ?></td>
                     <td><?php echo $car['rentperday']; ?></td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

<!-- Your existing scripts -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>
