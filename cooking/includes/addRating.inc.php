<?php
  include_once '../header.php';
  // include_once 'includes/index.inc.php';
?>
<?php




if (isset($_POST['submit'])) {
  $ratedById = $_POST["ratedById"];
  $recipeId = $_POST["recipeId"];
  $rating = $_POST["rating"];

  // print_r($_POST);
  // return;
  
  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';
  
  if (emptyInputAddRating($ratedById, $recipeId, $rating) !== false) {
    header("location: ../index.php?error=emptyinput");
    exit();
  }

  createRating($conn, $ratedById, $recipeId, $rating);
  
  
  
} else {
  header("location: ../addRecipe.php");
  exit();
}


