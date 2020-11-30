<?php


require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$recipes = allRecipes($conn);
if (isset($_SESSION['id'])) { 
  $sharedRecipes = sharedRecipes($conn);
}




// echo '<pre>';
// print_r($sharedRecipes);