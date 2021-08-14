<?php
  include_once 'header.php';

  $users = findOtherUsers($conn);
  // print_r($users);
?>

      <!-- <section class="signup-form">
        <h2>Sign Up</h2>
        <form class="" action="includes/signup.inc.php" method="post">
          <input type="text" name="name" placeholder="Full name...">
          <input type="text" name="email" placeholder="Email...">
          <input type="password" name="password" placeholder="Password...">
          <input type="password" name="passwordRepeat" placeholder="Repeat Password...">
          <button type="submit" name="submit">Sign Up</button>
        </form> -->


      <div class="container-fluid">
      <br/>
      <br/>
      <br/>

        <form class="" action="includes/addRecipe.inc.php" method="post" enctype="multipart/form-data" >
      
        <div class="simple-login-container" style="width: 60%">
          <h2 class="heading_title">Add Recipe</h2>
          </br>
          <div class="row">
              <div class="col-md-12 form-group">
                  <input name="title" type="text" class="form-control" placeholder="Title">

              </div>
          </div>

          <div class="row">
              <div class="col-md-12 form-group">
                  <input name="image" type="file" class="form-control" placeholder="Title">
              </div>
          </div>

          
          <div class="row">
            
              <div class="col-md-12 form-group">
                  <textarea name="description" type="text" class="form-control" rows="7" placeholder="Description"></textarea>
              </div>
              <div class="col-md-12 form-group">
                  <select name="sharedUserId" class="form-control"  >
                    <option value="0">All</option>
                      <?php foreach ($users as $k => $user) { ?>
                      <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                      <?php } ?>
                  </select>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12 form-group">          
                <input name="userId" type="hidden" class="form-control" value="<?php echo $_SESSION['id']; ?>" placeholder="userId">
                
                  <button class="btn btn-block btn-login" type="submit" name="submit">Add</button>
              </div>
          </div>
      </div>
        </form>


      </div>

  <?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
      } 
      else if ($_GET["error"] == "invalidemail") {
        echo "<p>Choose a proper email!</p>";
      } 
      else if ($_GET["error"] == "passwordsdontmatch") {
        echo "<p>Passwords doesn't match!</p>";
      } 
      else if ($_GET["error"] == "emailtaken") {
        echo "<p>Email already taken, try another!</p>";
      } 
      else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong, try again!</p>";
      } 
      else if ($_GET["error"] == "none") {
        // echo "<p>You have signed up!</p>";
      } 
    }
  
  ?>


<?php
  include_once 'footer.php';
?>