<?php

function emptyInputAddRating($ratedById, $recipeId, $rating) {
  $result;

  if ($rating == 0) {
    $result = true;
  } else {
    $result = false;
  }

  return $result;
}

function emptyInputAddRecipe($title, $description) {
  $result;

  if (empty($title) || empty($description)) {
    $result = true;
  } else {
    $result = false;
  }

  return $result;
}

function emptyInputSignup($name, $email, $password, $passwordRepeat) {
  $result;

  if (empty($name) || empty($email) || empty($password) || empty($passwordRepeat)) {
    $result = true;
  } else {
    $result = false;
  }

  return $result;
}

function emptyInputLogin($email, $password) {
  $result;

  if (empty($email) || empty($password)) {
    $result = true;
  } else {
    $result = false;
  }

  return $result;
}

function invalidEmail($email) {
  $result;

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  } else {
    $result = false;
  }

  return $result;
}

function passwordMatch($password, $passwordRepeat) {
  $result;

  if ($password !== $passwordRepeat) {
    $result = true;
  } else {
    $result = false;
  }

  return $result;
}

function emailExists($conn, $email) {
  $sql = "SELECT * FROM users WHERE email=?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close();
}

function createUser($conn, $name, $email, $password) {
  $sql = "INSERT INTO users (name, email, password) VALUES(?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close();

  header("location: ../signup.php?error=none");
    exit();
}

function deleteUserRatings($conn) {
  
  
  $sql = "DELETE FROM ratings WHERE ratedById=".$_SESSION['id'].";";
  // print_r($sql);
  // return;
  
  if (!$image) {
    $image = '';
  }
  
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php?error=stmtfailed");
    exit();
  }
  
  // mysqli_stmt_bind_param($stmt, "iii", $ratedById, $recipeId, $rating);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close();

  // header("location: ../index.php?error=none");
  //   exit();
}

function createRating($conn, $ratedById, $recipeId, $rating) {
  deleteUserRatings($conn);
  $sql = "INSERT INTO ratings (ratedById, recipeId, rating) VALUES(?, ?, ?);";
  // print_r($sql);
  // return;
  
  if (!$image) {
    $image = '';
  }
  
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../index.php?error=stmtfailed");
    exit();
  }
  
  mysqli_stmt_bind_param($stmt, "iii", $ratedById, $recipeId, $rating);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close();

  header("location: ../index.php?error=none");
    exit();
}

function createRecipe($conn, $image, $userId, $title, $description, $sharedUserId) {
  $sql = "INSERT INTO recipes (userId, title, description, image, sharedUserId) VALUES(?, ?, ?, ?, ?);";
  // print_r($sql);
  // return;
  
  if (!$image) {
    $image = '';
  }
  
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../addRecipe.php?error=stmtfailed");
    exit();
  }
  
  mysqli_stmt_bind_param($stmt, "isssi", $userId, $title, $description, $image, $sharedUserId);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close();

  header("location: ../index.php?error=none");
    exit();
}

function loginUser($conn, $email, $password) {
  $emailExists = emailExists($conn, $email);

  if ($emailExists === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $passwordHashed = $emailExists["password"];
  $checkPassword = password_verify($password, $passwordHashed);

  if ($checkPassword === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }
  else if ($checkPassword === true) {
    session_start();
    $_SESSION["id"] = $emailExists["id"];
    $_SESSION["email"] = $emailExists["email"];
    $_SESSION["user"] = $emailExists;
    
    header("location: ../index.php");
    exit();
  }
}


function allRecipes($conn) {
  $user_id = 0;
  
  if ($_SESSION && isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
  }
  // print_r($_SESSION);
  // return;
  $sql = "SELECT r.*, u.name as userName, IFNULL( ( SELECT AVG(rr.rating) FROM ratings rr WHERE rr.recipeId=r.id ), 0) as avgRating, ROUND(IFNULL( ( SELECT AVG(rr.rating) FROM ratings rr WHERE rr.recipeId=r.id ), 0)) as avgRatingRounded, ROUND(IFNULL( ( SELECT rr.rating FROM ratings rr WHERE rr.recipeId=r.id && rr.ratedById=".$user_id."), 0)) as myRating FROM recipes as r INNER JOIN users as u ON u.id=r.userId WHERE r.sharedUserId=0 ORDER BY r.id DESC;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  // mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);


  $rows = array();

  while(($row =  mysqli_fetch_assoc($resultData))) {
      $rows[] = $row;
  }
    
  return $rows;
  mysqli_stmt_close();
}

function sharedRecipes($conn) {
  $user_id = 0;
  
  if ($_SESSION && isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
  }
  
  $sql = "SELECT r.*, u.name as userName, IFNULL( ( SELECT AVG(rr.rating) FROM ratings rr WHERE rr.recipeId=r.id ), 0) as avgRating, ROUND(IFNULL( ( SELECT AVG(rr.rating) FROM ratings rr WHERE rr.recipeId=r.id ), 0)) as avgRatingRounded, ROUND(IFNULL( ( SELECT rr.rating FROM ratings rr WHERE rr.recipeId=r.id && rr.ratedById=".$user_id."), 0)) as myRating FROM recipes as r INNER JOIN users as u ON u.id=r.userId WHERE r.sharedUserId=".$_SESSION['id'].";";

  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: index.php?error=stmtfailed");
    exit();
  }

  // mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);
  
  $rows = array();

  while(($row =  mysqli_fetch_assoc($resultData))) {
      $rows[] = $row;
  }
    
  return $rows;
  mysqli_stmt_close();
}

function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function uploadFile($fileName, $file) {
  // print_r(__DIR__);
  // return;
  $_FILES = $file;
  
  $randomName = generateRandomString();
  $ext = pathinfo($_FILES[$fileName]["name"], PATHINFO_EXTENSION);

  
  $randomName = $randomName.time().'.'.$ext;
  // print_r($randomName);
  // return;
  
  
  $target_dir = __DIR__."/../img/";
  $target_file = $target_dir . $randomName;
  // $target_file = $target_dir . basename($_FILES[$fileName]["name"]);

  // print_r($target_file);
  // return;
  
  
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES[$fileName]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES[$fileName]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES[$fileName]["tmp_name"], $target_file)) {
      // echo "The file ". htmlspecialchars( basename( $_FILES[$fileName]["name"])). " has been uploaded.";
      return $randomName;
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}

function findOtherUsers($conn) {
  $sql = "SELECT u.id, u.name FROM users AS u WHERE id!=".$_SESSION['id']." ORDER BY u.name ASC;";
  // print_r($sql);
  // return;
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: addRecipe.php?error=stmtfailed");
    exit();
  }

  // mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);


  $rows = array();

  while(($row =  mysqli_fetch_assoc($resultData))) {
      $rows[] = $row;
  }
    
  return $rows;
  mysqli_stmt_close();
}

function getRatingStar($rating) {
  for ($i = 1; $i <= 5; $i++) {
    echo '<span class="fa_rate fa fa-star '.((int) $i <= (int) $rating ? 'checked' : '').'"></span>';
  }
}


