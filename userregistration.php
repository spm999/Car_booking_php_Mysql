<?php 
   require 'includes/snippet.php';
   require 'includes/db-inc.php';
   include "includes/header.php"; 
   
   if(isset($_POST['submit'])) {
       $name= sanitize(trim($_POST['name']));
       $email = sanitize(trim($_POST['email']));
       $username = sanitize(trim($_POST['username']));
       $password = sanitize(trim($_POST['password']));

         $sql = "INSERT INTO user( name, email, username, password ) VALUES ('$name',  '$email', '$username','$password') ";
   
         $query = mysqli_query($conn, $sql);
         $error = false;
         if($query){
         $error = true;
         echo "<script>alert('Registration successful!!');</script>";
         header("Location: userlogin.php");
         }
         else{
           echo "<script>alert('Registration failed!! Try again.');
                       </script>";
         }
   }
   
   ?>

<div class="container">
   <div class="row justify-content-center align-items-center vh-100">
         <div class=" col-xs-12 col-sm-6 col-sm-offset-3">
         <div class="card">
            <div class="card-header">
               <h3 class="text-center">User Registration</h3>
            </div>
            <div class="card-body">
               <form method="post">
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                  <div class="form-group">
                     <label for="userId">User Name</label>
                     <input type="text" class="form-control" id="username" name="username" required>
                  </div>
                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div> 

<br>
<br>
<div class="container">
   <div class="row row-sm-10 col-lg-12 col-md-4 col-sm-11 col-xs-11 " style="align-content: center;">
         <a href="carstorent.php"><button class="btn btn-success col-lg-12 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-home"></span>&nbsp&nbspCars To Rent</button></a>
   </div>
</div>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"> </script>

</body>
</html>
