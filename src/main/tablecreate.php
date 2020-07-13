<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "library_management";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "INSERT INTO SECTION(S_ID,S_NAME,RACK_NO)VALUES('E2','BIG DATA',4)
";


if (mysqli_query($conn, $sql)) {
    echo "UPDATED successfully";
} else {
    echo "Error INSERTING: " .mysqli_error($conn);
}

mysqli_close($conn)

?>
