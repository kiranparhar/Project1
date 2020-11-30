<?php
  include_once 'header.php';
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

        <form class="" action="includes/signup.inc.php" method="post">
      
        <div class="simple-login-container">
        <h2 class="heading_title">Sign Up</h2>
          </br>
          <div class="row">
              <div class="col-md-12 form-group">
                  <input name="name" type="text" class="form-control" placeholder="Full Name">
              </div>
          </div>
          <div class="row">
              <div class="col-md-12 form-group">
                  <input name="email" type="text" class="form-control" placeholder="Email">
              </div>
          </div>
          <div class="row">
              <div class="col-md-12 form-group">
                  <input name="password" type="password" placeholder="Enter your Password" class="form-control">
              </div>
          </div>
          <div class="row">
              <div class="col-md-12 form-group">
                  <input name="passwordRepeat" type="password" placeholder="Enter Confirm Password" class="form-control">
              </div>
          </div>
          <div class="row">
              <div class="col-md-12 form-group">          
                  <button class="btn btn-block btn-login" type="submit" name="submit">Sign Up</button>
              </div>
          </div>
          <div class="row error_message_div">             
            <div class="col-md-12 form-group">      
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
                  echo "<p>You have signed up!</p>";
                } 
              }
            
              ?>
            </div>
          </div>
      </div>
        </form>


      </div>


<?php
  include_once 'footer.php';
?>