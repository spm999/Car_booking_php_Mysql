<?php 
// session_start();
if (!(isset($_SESSION['auth']) && $_SESSION['auth'] == true)) {
	header('Location: '.$_SERVER['PHP_SELF']);
die;
	exit();
}

?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example">
                <span class="sr-only">:</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">CAR RENTAL SYSTEM</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example">
            <ul class="nav navbar-nav">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Logout</a></li>
            </ul>
</ul>
        </div>
    </div>
</nav>