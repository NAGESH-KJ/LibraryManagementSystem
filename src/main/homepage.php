<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
    <meta charset="utf-8">
    <title>QUERIES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<style media="screen">
			  * {
  				border-radius: 0 !important;
				}

				* {
					-webkit-border-radius: 0 !important;
     			-moz-border-radius: 0 !important;
          border-radius: 0 !important;
				}
				html {
                    overflow-x: hidden;
										background-image: url("home.jpg")
        }
		</style>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">	
			<div class="navbar-header">
				<a class="navbar-brand" href="homepage.php"> Library Management System </a>
			</div>
		</div>
		<ul class="nav navbar-nav">
      <li class="active"><a href="homepage.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      <li><a href="addbook.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Book</a></li>
			<li><a href="issuebook.php"><span class="glyphicon glyphicon-book"></span> Issue Book</a></li>
			<li><a href="returnbook.php"><span class="glyphicon glyphicon-retweet"></span> Return Book</a></li>
			<li class="dropdown">
        		<a class="dropdown-toggle" data-toggle="dropdown">Search
        		<span class="caret"></span></a>
        		<ul class="dropdown-menu">
          			<li><a href="searchtitle.php">By Title</a></li>
          			<li><a href="searchstudent.php">By student</a></li>
          			<li><a href="searchauthor.php">By authors</a></li>
        		</ul>
    	</li>
    </ul>
		<ul class="nav navbar-nav navbar-right" style="padding-right:15px">
      <li><a href="signin.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
	</nav>
	<h2 class="col-sm-6 col-sm-offset-1" style="color:white;">
		Welcome <?php echo $_SESSION['username']; ?>
			</h2>
</body>
</html>