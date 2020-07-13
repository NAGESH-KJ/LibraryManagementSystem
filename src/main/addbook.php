<!DOCTYPE html>
<?php
    $db = mysqli_connect('localhost', 'username', 'password','library_management');
    $result_message = "";

    if(isset($_POST['add'])) {
        $title_name = $_POST['t_name'];
        $quantity = $_POST['quantity'];
        $edition = $_POST['edition'];

        $query = "SELECT * FROM title WHERE T_NAME='$title_name' AND EDITION='$edition'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 1) {
            $update_query = "UPDATE title SET QUANTITY = QUANTITY + $quantity WHERE T_NAME='$title_name'";
            $update_result = mysqli_query($db, $update_query);
            $result_message = "Book already exists. Updated quantity!";
        } else {
            $isbn = $_POST['isbn'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            
            $publisher_id = $_POST['p_id'];
            $publisher_name = $_POST['p_name'];
            $author_name = $_POST['auth_name'];
            $publisher_phone = $_POST['pub_phone'];
            $area = $_POST['area'];
            $streetno = $_POST['streetno'];
            $zip = $_POST['zip'];

            $check_query = "SELECT P_ID FROM publisher WHERE P_ID='$publisher_id'";
            $result = mysqli_query($db, $check_query);
            if(mysqli_num_rows($result) == 0) {
                $insert_query1 = "INSERT INTO publisher (P_ID, P_NAME, STREET_NO, AREA, ZIP) VALUES ('$publisher_id', '$publisher_name', '$streetno', '$area', '$zip')";
                $insert_query2 = "INSERT INTO publisher_phone (P_ID, P_PHONE) VALUES ('$publisher_id', '$publisher_phone')";
                mysqli_query($db, $insert_query1);
                mysqli_query($db, $insert_query2);
            } 
            $insert_query3 = "INSERT INTO title (ISBN, T_NAME, EDITION, PRICE, QUANTITY, CATEGORY, P_ID) VALUES ('$isbn', '$title_name', '$edition', '$price', '$quantity', '$category', '$publisher_id')";
            $insert_query4 = "INSERT INTO author (NAME, ISBN) VALUES ('$author_name', '$isbn')";
            mysqli_query($db, $insert_query3);
            mysqli_query($db, $insert_query4);
            $result_message = "Added book to the database";
        }

        mysqli_close($db);
    }

?>
<html>
<head>
    <meta charset="utf-8">
    <title>QUERIES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/188F7085-6F71-C44D-A87E-5964282FF920/main.js" charset="UTF-8"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
                button:hover {
                    opacity: 0.8;
                    transition: 0.3s ease;
                }
                html {
                    overflow-x: hidden;
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
            <li><a href="homepage.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li class="active"><a href="addbook.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Book</a></li>
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
    <form class="horizontal" action="addbook.php" method="POST">
        <div class="row">
            <div class="col-sm-6">
                <h2>Title Details</h2><br>
                <label class="control-label col-sm-2">Title Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="t_name" name="t_name" placeholder="Enter Title name">
                </div><br><br>
                <label class="control-label col-sm-2">ISBN:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Enter ISBN">
                </div><br><br>
                <label class="control-label col-sm-2">Edition:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="edition" name="edition" placeholder="Enter the edition">
                </div><br><br>
                <label class="control-label col-sm-2">Price:</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter the Price">
                </div><br><br>
                <label class="control-label col-sm-2">Quantity:</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity">
                </div><br><br>
                <label class="control-label col-sm-2">Category:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="category" name="category" placeholder="Enter the category">
                </div>

            </div>
            <div class="col-sm-6">
                <h2>Publisher Details</h2><br>
                <label class="control-label col-sm-2">Publisher ID:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="p_id" name="p_id" placeholder="Enter Publisher ID">
                </div><br><br><br>
                <label class="control-label col-sm-2">Publisher Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Enter Publisher Name">
                </div><br><br><br>
                <label class="control-label col-sm-2">Author Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="auth_name" name="auth_name" placeholder="Enter Author Name">
                </div><br><br><br>
                <label class="control-label col-sm-2">Publisher Phone:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="pub_phone" name="pub_phone" placeholder="Enter Phone Number">
                </div><br><br><br>
                <label class="control-label col-sm-2">Area:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="area" name="area" placeholder="Enter the Area">
                </div><br><br>
                <label class="control-label col-sm-2">Street No:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="streetno" name="streetno" placeholder="Enter Street No">
                </div><br><br>
                <label class="control-label col-sm-2">Zip:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="zip" name="zip" placeholder="Enter  the Zip">
                </div><br><br><br><br>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-10">
                <button type="submit" class="btn btn-default" style="background-color:black; color:white;" name="add">Submit</button>
            </div>
        </div>
    </form><br><br>
    <div class="col-sm-offset-5 col-sm-3">
        <?php echo $result_message ?>
    </div>
</body>
</html>