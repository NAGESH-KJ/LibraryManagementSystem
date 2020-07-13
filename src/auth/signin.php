<?php include('liblogin.php')  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" type = "text/css" href="signin.css">
    <style media="screen">

      html, body {
        width: 100%;
        height: 100%;
        font-family: sans-serif;
        font-size: 0.8em;
      }
      body {
        display: flex;
        background-image: url(lib1.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-blend-mode: lighten;
      }
      form {
        margin: auto;
      }
    </style>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <form method="POST" action="signin.php">
  <div class="container">
    <h1 style="color:antiquewhite;">Sign In</h1>
    <input type="text" placeholder="Username" name="unamel" required><br>
    <input type="password" placeholder="Password" name="pswl" required><br>
<br>
    <button type="submit" name="login" style="margin-left: 70px">Login</button>
  </div>
  <div class="container">
    <?php echo $passwordemailerror; ?><br>
  </div>
</form>
  </body>
</html>
