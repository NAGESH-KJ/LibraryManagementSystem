<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>QUERIES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
	  <div class="content-wrapper">
	    <div class="container">
        <?php include('navbar.php'); ?>
        <br><br>
        </div>
        <form class="form-horizontal" margin-left="20px" action="/action_page.php">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">ISBN:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" placeholder="Enter ISBN">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Name:</label>
                <div class="col-sm-10"> 
                    <input type="text" class="form-control" id="pwd" placeholder="Enter name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Edition:</label>
                <div class="col-sm-10"> 
                    <input type="number" class="form-control" id="pwd" placeholder="Enter Editon">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Price:</label>
                <div class="col-sm-10"> 
                    <input type="number" class="form-control" id="pwd" placeholder="Enter price">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Category:</label>
                <div class="col-sm-10"> 
                    <input type="text" class="form-control" id="pwd" placeholder="Enter category">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Publisher ID:</label>
                <div class="col-sm-10"> 
                    <input type="text" class="form-control" id="pwd" placeholder="Enter P_ID">
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>