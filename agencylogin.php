<?php
session_start();

if ((isset($_SESSION['auth']) && $_SESSION['auth'] === true)) {
    header("Location: addnewcars.php");
    exit();
}

if (isset($_GET['access'])) {
        $alert_user = true;
}


require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";

if(isset($_POST['submit'])){
   $agencyname = sanitize(trim($_POST['agencyname']));
   $password = sanitize(trim($_POST['password']));

   $sql_admin = "SELECT * from agency where agencyname = '$agencyname' and  password = '$password' ";
   $query = mysqli_query($conn, $sql_admin);

   echo mysqli_error($conn);
   if(mysqli_num_rows($query) > 0)
   {
            while($row = mysqli_fetch_assoc($query)){
               $_SESSION['auth'] = true;
               $_SESSION['agency'] = $row['agencyname'];		
               }
               if ($_SESSION['auth'] === true) {
            header("Location: addnewcars.php");
            exit();
               }
   }
         else {
                  echo"<div class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <strong style='text-align: center'> Wrong Username and Password.</strong>  </div>";
               }		
         }
?>


<div class="container">
   <div class="row">
      <div class="col-xs-12 col-sm-6 col-sm-offset-3">
         <div class="card">
            <h3 class="text-center">Agency Login</h3>
            <form method="post">
               <div class="form-group">
                  <label for="agencyname">Username</label>
                  <input type="text" class="form-control" id="agencyname" name="agencyname" required>
               </div>
               <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
               </div>
               <button type="submit" name="submit" class="btn btn-info btn-block" >Login</button>
            </form>
         </div>
      </div>
   </div>
</div>

<br>
<br>



<div class="container">
   <div class="row row-sm-10" style="align-content: center;">
         <a href="carstorent.php"><button class="btn btn-success col-lg-12 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbspCars To Rent</button></a>
   </div>
</div>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"> </script> 

<?php if (isset($alert_user)) { ?>
<!-- <script type="text/javascript">
   swal("Oops...", "You are not allowed to view this page directly...!", "error");
</script> --> 
<?php } ?>
</body>
</html>