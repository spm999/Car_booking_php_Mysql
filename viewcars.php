<?php
session_start();

if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: agencylogin.php");
    exit();
}

$agencyname = $_SESSION['agency'];

require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php"; 

$agencyid = null;
if ($stmt = $conn->prepare("SELECT agencyid FROM agency WHERE agencyname = ?")) {
    $stmt->bind_param("s", $agencyname);
    $stmt->execute();
    $stmt->bind_result($agencyid);
    $stmt->fetch();
    $stmt->close();
}

// Fetch the list of cars added by the agency
$cars = array();
if ($stmt = $conn->prepare("SELECT * FROM cars WHERE agencyid = ?")) {
    $stmt->bind_param("i", $agencyid);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }
    $stmt->close();
}

// Delete a car
if(isset($_POST['del'])){
   
    $id = sanitize(trim($_POST['carId']));

    $sql_del = "DELETE from cars where carId = $id"; 
    $error = false;
    $result = mysqli_query($conn,$sql_del);
            if ($result)
            {
            $error = true; //delete successful
            }			
            header("Location: viewcars.php");
 }
?>


<div class="container">
    <?php include "includes/nav.php"; ?>
    <div class="container col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0" style="margin-top: 20px">
        <div class="jumbotron login col-lg-10 col-md-11 col-sm-12 col-xs-10">
            <p class="page-header" style="text-align: center"><b>VIEW CARS</b></p>
            <div class="container">
                <form method="post">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Vehicle Model</th>
                                <th>Vehicle Number</th>
                                <th>Seating Capacity</th>
                                <th>Rent Per Day</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cars as $car) { ?>
                                <tr>
                                    <td><?php echo $car['vehiclemodel']; ?></td>
                                    <td><?php echo $car['vehicleno']; ?></td>
                                    <td><?php echo $car['seatingcapacity']; ?></td>
                                    <td><?php echo $car['rentperday']; ?></td>
                                    <td>
                                        <input type="hidden" name="carId" value="<?php echo $car['carId']; ?>">
                                        <button name='del' type='submit' class='btn btn-warning'>DELETE</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
   <div class="row row-sm-10" style="align-content: center;">
         <a href="viewbookedcars.php"><button class="btn btn-success col-lg-12 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbspVIEW BOOKED CARS</button></a>
   </div>
</div>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>
