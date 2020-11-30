<?php
  session_start();
  require_once 'includes/functions.inc.php';
  include_once 'includes/dbh.inc.php';

  $baseFolder = "/cooking/";
  
  // print_r($_SERVER);
  
  // $endUrlArray = explode('/', $_SERVER["PHP_SELF"]);
  // $endUrl = $endUrlArray[count($endUrlArray) - 1];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Cooking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>

      <link rel="stylesheet" href="css/reset.css">
      <link rel="stylesheet" href="css/style.css">
  </head>
  <body style="background-image: url('img/cooking_background5.jpg'); background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <!-- Brand/logo -->
      <a class="navbar-brand" href="#">
        <img src="img/cooking_logo.png" alt="logo" style="width:40px;">
      </a>
      
      <!-- Links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php echo ($_SERVER["PHP_SELF"] == $baseFolder."index.php" ? "active" : ""); ?>" href="index.php">Home</a>
        </li>
        <?php
          if (isset($_SESSION["id"])) {
            // echo '<li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>';

            echo '<li class="nav-item"><a class="nav-link" href="includes/logout.inc.php">Log out</a></li>';            
          } else {
            echo '<li class="nav-item"><a class="nav-link '.($_SERVER["PHP_SELF"] == $baseFolder."signup.php" ? "active" : "").'" href="signup.php">Sign up</a></li>';            
            echo '<li class="nav-item"><a class="nav-link '.($_SERVER["PHP_SELF"] == $baseFolder."login.php" ? "active" : "").'" href="login.php">Log in</a></li>';
          }
        ?>
      </ul>
    </nav>
  

      <div class="wrapper">