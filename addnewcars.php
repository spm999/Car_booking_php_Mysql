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


// Retrieve agencyid of the logged-in agency
$agencyid = null;
if ($stmt = $conn->prepare("SELECT agencyid FROM agency WHERE agencyname = ?")) {
    $stmt->bind_param("s", $agencyname);
    $stmt->execute();
    $stmt->bind_result($agencyid);
    $stmt->fetch();
    $stmt->close();
}

if(isset($_POST['submit'])){

//    $agencyid = sanitize(trim($_SESSION['agencyid']));
   $vehiclemodel = sanitize(trim($_POST['vehiclemodel']));
   $vehicleNo = sanitize(trim($_POST['vehicleno']));
   $seatingcapacity = sanitize(trim($_POST['seatingcapacity']));
   $rentperday = sanitize(trim($_POST['rentperday']));

   $sql = "INSERT INTO cars(agencyid, vehiclemodel, vehicleno, seatingcapacity, rentperday)
           VALUES ('$agencyid','$vehiclemodel','$vehicleNo', '$seatingcapacity','$rentperday')";
   $query = mysqli_query($conn, $sql);

   if($query){
       echo "<script>alert('New Car has been added ');
                location.href ='addnewcars.php';
                </script>";
   }
   else {
       echo "<script>alert('Car not added!');
                </script>"; 
   }
}
?>

<div class="container">
   <?php include "includes/nav.php"; ?>
   <div class="container  col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0  " style="margin-top: 20px">
      <div class="jumbotron login col-lg-10 col-md-11 col-sm-12 col-xs-10">
         <?php if(isset($error) && $error === true) { ?>
         <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Record added Successfully!</strong>
         </div>
         <?php } ?>
         <p class="page-header" style="text-align: center"><b>ADD CAR</b></p>
         <div class="container">
            <form class="form-horizontal" role="form" action="addnewcars.php" method="post" enctype="multipart/form-data">
               <div class="form-group">
                  <label for="vehiclemodel" class="col-sm-2 control-label">Vehicle Model</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="vehiclemodel" placeholder="Vehicle Model" id="vehiclemodel" required>
                  </div>
               </div>
               <div class="form-group">
                  <label for="vehicleno" class="col-sm-2 control-label">Vehicle Number</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="vehicleno" placeholder="Vehicle Number" id="vehicleno" required>
                  </div>
               </div>
               <div class="form-group">
                  <label for="seatingcapacity" class="col-sm-2 control-label">Seating Capacity</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="seatingcapacity" placeholder="Seating Capacity" id="seatingcapacity" required>
                  </div>
               </div>
               <div class="form-group">
                  <label for="rentperday" class="col-sm-2 control-label">Rent Per Day</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="rentperday" placeholder="Rent Per Day" id="rentperday" required>
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                     <button  class="btn btn-info col-lg-12" data-toggle="modal" data-target="#info" name="submit">
                     ADD CAR
                     </button>                            
                  </div>
               </div>
               <input type="hidden" name="agencyid" value="<?php echo $agencyid; ?>">
            </form>
         </div>
      </div>
   </div>
</div>


<div class="container">
   <div class="row row-sm-10" style="align-content: center;">
         <a href="viewcars.php"><button class="btn btn-success col-lg-12 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbspVIEW CARS</button></a>
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