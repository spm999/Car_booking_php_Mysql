<?php 
    include "includes/header.php"; 
    include "includes/db-inc.php"; 
?>

<div class="container">

   <!-- info alert -->
   <div class="alert alert-warning col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="margin-top:70px">
      <span class="glyphicon glyphicon-book"></span>
      <strong>CARS TO RENT</strong>
   </div>
</div>

<div class="container">
   <div class="row">
      <a href="index.php"><button class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbspHOME</button></a>
   </div>

   <div class="panel panel-default">
      <table class="table table-bordered">
         <thead>
            <tr>
               <th>Car Number</th>
               <th>Vehicle Model</th>
               <th>Vehicle Number</th>
               <th>Seating Capacity</th>
               <th>Rent Per Day</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody> <!-- Move the <tbody> tag here -->
            <?php 
            $sql = "SELECT * from cars";
            $query = mysqli_query($conn, $sql); 
            while ($row = mysqli_fetch_array($query)) { ?>
            <tr> <!-- Start a new row for each car -->
               <td><?php echo $row['carId']; ?></td>
               <td><?php echo $row['vehiclemodel']; ?></td>
               <td><?php echo $row['vehicleno']; ?></td>
               <td><?php echo $row['seatingcapacity']; ?></td>
               <td><?php echo $row['rentperday']; ?></td>
               <td>
                  <a href="userlogin.php" class="btn btn-primary">Rent Car</a>
               </td>
            </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>	
</body>
</html>
