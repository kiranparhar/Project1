<?php




if (isset($_POST['submit'])) {
  $title = $_POST["title"];
  $description = $_POST["description"];
  $userId = $_POST["userId"];
  $sharedUserId = $_POST["sharedUserId"];
  
  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';
  
  if (emptyInputAddRecipe($title, $description) !== false) {
    header("location: ../addRecipe.php?error=emptyinput");
    exit();
  }


  // print_r(($_POST));
  // return;

  $image;
  if (count($_FILES) > 0 && isset($_FILES['image']) && $_FILES['image']) {
    $image = uploadFile('image', $_FILES);
  }


  createRecipe($conn, $image, $userId, $title, $description, $sharedUserId);
  
  
  
} else {
  header("location: ../addRecipe.php");
  exit();
}


