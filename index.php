<?php
session_start();

require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";

?>
<div class="container">
    <div class="row text-center">
        <div class="col-lg-12 col-md-6 col-sm-12 mb-8">
            <a href="userregistration.php" class="btn btn-lg btn-primary btn-block">Register as User</a>
        </div>
</div>
<br>
<br>
<div class="row text-center">
        <div class="col-lg-12 col-md-6 col-sm-12 mb-4">
            <a href="agencyregistration.php" class="btn btn-lg btn-success btn-block">Register as Car Agency</a>
        </div>
</div>
<br>
<br>

        <div class="row text-center">
        <div class="col-lg-12 col-md-6 col-sm-12 mb-4">
            <a href="userlogin.php" class="btn btn-lg btn-info btn-block">User Login</a>
        </div>
</div>

<br>
<br>
<div class="row text-center">
        <div class="col-lg-12 col-md-6 col-sm-12 mb-4">
            <a href="agencylogin.php" class="btn btn-lg btn-info btn-block">Agency Login</a>
        </div>
    </div>
<br>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-12 col-sm-12 mb-4  ">
            <form method="post" action="carstorent.php">
                <button class="btn btn-success btn-block" style="margin-left:-12px;" name="rent">
                    <span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Cars To Rent
                </button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>
