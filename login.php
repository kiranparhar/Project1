<?php
  include_once 'header.php';
?>

      <div class="container-fluid">
      <br/>
      <br/>
      <br/>

        <form class="" action="includes/login.inc.php" method="post">
      
        <div class="simple-login-container">
          <h2 class="heading_title">Log In</h2>
          </br>
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
                  <button class="btn btn-block btn-login" type="submit" name="submit">Log In</button>
              </div>
          </div>
          <div class="row error_message_div">             
            <div class="col-md-12 form-group">      
            <?php
                if (isset($_GET["error"])) {
                  if ($_GET["error"] == "emptyinput") {
                    echo "<p>Fill in all fields!</p>";
                  } 
                  else if ($_GET["error"] == "wronglogin") {
                    echo "<p>Incorrect login information!</p>";
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