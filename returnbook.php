<!DOCTYPE html>
<?php
    $db = mysqli_connect('localhost', 'username', 'password','library_management');
    $result_message = "";

    if(isset($_POST['return'])) {
      $book_id = $_POST['book-id'];
      $query = "SELECT RETURN_DATE FROM book WHERE ID = '$book_id'";
      $result_query = mysqli_query($db, $query);
      $return_date = mysqli_fetch_row($result_query)[0];
      $query2 = "SELECT NOW()";
      $result_query2 = mysqli_query($db, $query2);
      $now = time();
      $return_date = strtotime($return_date);
      if($return_date < $now) {
        $datediff = $now - $return_date;
        $datediffdays = round($datediff / (60 * 60 * 24));
        $fine = $datediffdays * 10;
        $result_message = "Book returned. Collect fine of ₹{$fine}.";
      } 
      $query3 = "SELECT M_ID FROM book WHERE ID = '$book_id'";
      $result_query3 = mysqli_query($db, $query3);
      $mem_id = mysqli_fetch_row($result_query3)[0];
      $query4 = "SELECT E_ID FROM book WHERE ID = '$book_id'";
      $result_query4 = mysqli_query($db, $query4);
      $e_id = mysqli_fetch_row($result_query4)[0];
      $drop_query = "DELETE FROM book WHERE ID = '$book_id'";
      mysqli_query($db, $drop_query);
      $isbn_query = "SELECT ISBN FROM book WHERE ID='$book_id'";
      $isbn_result = mysqli_query($db, $isbn_query);
      $isbn = mysqli_fetch_row($isbn_result)[0];
      $update_query = "UPDATE title SET QUANTITY = QUANTITY + 1 WHERE ISBN = '$isbn'";
      mysqli_query($db, $update_query);
      $check_student = "SELECT * FROM book WHERE M_ID = '$mem_id' AND E_ID='$e_id'";
      $check_result = mysqli_query($db, $check_student);
      if(mysqli_num_rows($check_result) == 0) {
        $check_phone = "SELECT * FROM student WHERE M_ID='$mem_id'";
        $phone_result = mysqli_query($db, $check_phone);
        if(mysqli_num_rows($phone_result) == 1) {
          $drop_phone = "DELETE FROM student_phone WHERE M_ID='$mem_id'";
          mysqli_query($db, $drop_phone);
        }
        $drop_student = "DELETE FROM student WHERE M_ID='$mem_id' AND E_ID='$e_id'";
        mysqli_query($db, $drop_student);
      }
      if($result_message == "") {
        $result_message = "Book returned";
      }
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
      <li><a href="addbook.php"><span class="glyphicon glyphicon-plus-sign"></span> Add Book</a></li>
      <li><a href="issuebook.php"><span class="glyphicon glyphicon-book"></span> Issue Book</a></li>
      <li class="active"><a href="returnbook.php"><span class="glyphicon glyphicon-retweet"></span> Return Book</a></li>
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
  <div class="col-sm-6">
    <h2>Return Book</h2><br>
    <form class="horizontal" action="returnbook.php" method="POST">  
      <label class="control-label col-sm-2">Book ID:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="book-id" name="book-id" placeholder="Enter Book ID">
      </div><br><br><br><br><br><br>
      <div class="form-group">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-default" style="background-color:black; color:white;" name="return">Submit</button>
        </div>
      </div>
    </form>          
  </div>
  <div class="col-sm-offset-2 col-sm-3">
    <?php echo $result_message; ?>
  </div>
</body>
</html>