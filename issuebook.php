<!DOCTYPE html>
<?php
    session_start();
    $db = mysqli_connect('localhost', 'username', 'password','library_management');
    $result_message = "";

    if(isset($_POST['issue'])) {
        $book_id = $_POST['book-id'];
        $membership_id = $_POST['mem-id'];
        $username = $_SESSION['username'];
        $get_query = "SELECT E_ID FROM librarian WHERE USERNAME='$username'";
        $get_result = mysqli_query($db, $get_query);
        $e_id = mysqli_fetch_row($get_result)[0];
        $check_query1 = "SELECT * FROM student WHERE M_ID = '$membership_id' AND E_ID = '$e_id'";
        $result1 = mysqli_query($db, $check_query1);
        if(mysqli_num_rows($result1) == 0) {
            $srn = $_POST['srn'];
            $first_name = $_POST['fname'];
            $middle_name = $_POST['mname'];
            $last_name = $_POST['lname'];
            $department = $_POST['dept'];
            $year = $_POST['year'];
            $section = $_POST['section'];
            $student_phone = $_POST['stud_phone'];
            $dob = $_POST['dob'];
            $insert_query1 = "INSERT INTO student (M_ID, SRN, F_NAME, M_NAME, L_NAME, DEPT, YEAR, SECTION, DOB, E_ID) VALUES ('$membership_id', '$srn', '$first_name', '$middle_name', '$last_name', '$department', '$year', '$section', '$dob', '$e_id')";
            $insert_query2 = "INSERT INTO student_phone(M_ID, S_PHONE) VALUES ('$membership_id', '$student_phone')";
            mysqli_query($db, $insert_query1);
            mysqli_query($db, $insert_query2);
        }
        $isbn = $_POST['isbn'];
        $check_quantity = "SELECT QUANTITY FROM title WHERE ISBN = '$isbn'";
        $quantity_result = mysqli_query($db, $check_quantity);
        $quantity = mysqli_fetch_row($quantity_result)[0];
        $check_query = "SELECT ID FROM book WHERE id='$book_id'";
        $result = mysqli_query($db, $check_query);
        if(mysqli_num_rows($result) == 0 and $quantity > 0) {
            $section_id = $_POST['section-id'];
            $borrow_date = $_POST['borrow_date']; 
            $return_date = $_POST['return_date'];
            $insert_query3 = "INSERT INTO book (ID, M_ID, S_ID, BORROW_DATE, RETURN_DATE, FINE, ISBN, E_ID) VALUES ('$book_id', '$membership_id', '$section_id', '$borrow_date', '$return_date', 0, '$isbn', '$e_id')";
            mysqli_query($db, $insert_query3);
            $update_query = "UPDATE title SET QUANTITY = QUANTITY - 1 WHERE ISBN = '$isbn'";
            mysqli_query($db, $update_query);
            $result_message = "Book has been issued";
        } else {
            $result_message = "No available books";
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
            <li class="active"><a href="issuebook.php"><span class="glyphicon glyphicon-book"></span> Issue Book</a></li>
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
    <form class="horizontal" action="issuebook.php" method="POST">
        <div class="row">
            <div class="col-sm-6">
                <h2>Book Details</h2><br>
                <label class="control-label col-sm-2">Book ID:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="book-id" name="book-id" placeholder="Enter Book ID">
                </div><br><br>
                <label class="control-label col-sm-2">ISBN:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Enter ISBN">
                </div><br><br>
                <label class="control-label col-sm-2">Borrow Date:</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="borrow_date" name="borrow_date">
                </div><br><br><br>
                <label class="control-label col-sm-2">Return Date:</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="return_date" name="return_date">
                </div><br><br><br>
                <label class="control-label col-sm-2">Section ID:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="section-id" name="section-id" placeholder="Enter Section ID">
                </div>
            </div>
            <div class="col-sm-6">
                <h2>Student Details</h2><br>
                <label class="control-label col-sm-2">Membership ID:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="mem-id" name="mem-id" placeholder="Enter Membership ID">
                </div><br><br><br>
                <label class="control-label col-sm-2">SRN:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="srn" name="srn" placeholder="Enter SRN">
                </div><br><br>
                <label class="control-label col-sm-2">First Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name">
                </div><br><br>
                <label class="control-label col-sm-2">Middle Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter Middle Name">
                </div><br><br><br>
                <label class="control-label col-sm-2">Last Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name">
                </div><br><br>
                <label class="control-label col-sm-2">Department:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="dept" name="dept" placeholder="Enter Department">
                </div><br><br>
                <label class="control-label col-sm-2">Year:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="year" name="year" placeholder="Enter Year">
                </div><br><br>
                <label class="control-label col-sm-2">Section:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="section" name="section" placeholder="Enter Section">
                </div><br><br>
                <label class="control-label col-sm-2">Student Phone:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="stud_phone" name="stud_phone" placeholder="Enter Student Phone">
                </div><br><br><br>
                <label class="control-label col-sm-2">Date of Birth:</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="dob" name="dob">
                </div><br><br><br><br>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-10">
                <button type="submit" name="issue" class="btn btn-default" style="background-color:black; color:white;">Submit</button>
            </div>
        </div>
    </form><br><br>
    <div class="col-sm-offset-5 col-sm-3">
        <?php echo $result_message; ?>
    </div>
</body>
</html>