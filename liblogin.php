<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$usernameerror = "";
$emailerror = "";
$passwordmatcherror = "";
$passwordemailerror = "";
$passwordmatcherror1 = "";

// connect to the database
$db = mysqli_connect('localhost', 'username', 'password','library_management');

if(isset($_POST['login'])) {
  $username = $_POST['unamel'];
  $password = $_POST['pswl'];

  $query = "SELECT * FROM librarian WHERE username='$username' AND p_word='$password'";
  $result = mysqli_query($db, $query);
  if(mysqli_num_rows($result) == 1) {
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: homepage.php');
  } else {
    $passwordemailerror = "Password does not match";
  }
}
?>