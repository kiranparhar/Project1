<?php
  include_once 'header.php';
  include_once 'includes/index.inc.php';
?>


<style>

.checked {
  color: orange !important;
}
</style>

<div class="container-fluid">
 <!-- <br/> -->
 <br/>
 <!-- <br/> -->

 <div class="col-xs-12 ">
          <?php if (isset($_SESSION['id'])) { ?>
          <div class="row">
              <div class="col-md-12 form-group">          
                  <a href="addRecipe.php" class="btn btn-warning add_recipe_button" type="button" >Add Recipe</a>
              </div>
          </div>
          <?php } ?>
   
				<nav>
					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Shared with all</a>

            <?php if (isset($_SESSION["id"])) { ?>
            
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Shared with me</a>

            <?php } ?>
            
					</div>
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						
            <br/>
            
            <?php
            if (count($recipes)) {
              foreach( $recipes as $key => $recipe) {
                // echo '<pre>';
                // print_r($recipe);
            ?>
            
          <div class="well" recipe_id="<?php echo $recipe['id']; ?>" my_rating="<?php echo $recipe['myRating']; ?>" >
                    <div class="media">
                    <a class="pull-left" href="#">
                    <img class="media-object" src="<?php echo $recipe['image'] == '' ? 'img/cooking_dummy.png' : 'img/'.$recipe['image']; ?>">
                    </a>
                    <div class="media-body">
                      <h4 class="media-heading ">
                        <span class="heading">
                          <?php echo $recipe['title']; ?>
                        </span>
                        <!-- <div class="rating"> -->
                        <?php getRatingStar($recipe['avgRating']); ?>
                        <?php echo number_format($recipe['avgRating'], 1) . "/5.0"; ?>
                        <!-- </div> -->
                        <p class="text-right right">By <?php echo $recipe['userName']; ?></p>
                      </h4>
                        <p class="recipe_description"><?php echo $recipe['description']; ?></p>

                        
                      
                    </div>
                  </div>
                </div>

              <?php 
                  } 
                } else {
              ?>
                    <div class="well" >
                      <div class="media">
                      <div class="media-body">                      
                        <h4 class="recipe_description"><?php echo "<center>No recipe found</center>";; ?></h4>                         
                      </div>
                    </div>
                  </div>
              <?php                  
                }
              ?>


            
					</div>


          <?php if (isset($_SESSION["id"])) { ?>
          
					<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

          <br/>
            
                  <?php
                  if (count($sharedRecipes)) {
                    foreach( $sharedRecipes as $key => $recipe) {
                  ?>
                  
                <!-- <div class="well"> -->
                <div class="well" recipe_id="<?php echo $recipe['id']; ?>" my_rating="<?php echo $recipe['myRating']; ?>" >
                    <div class="media">
                    <a class="pull-left" href="#">
                      <img class="media-object" src="<?php echo $recipe['image'] == '' ? 'img/cooking_dummy.png' : 'img/'.$recipe['image']; ?>">
                    </a>
                    <div class="media-body">
                      <h4 class="media-heading ">
                        <span class="heading">
                          <?php echo $recipe['title']; ?>
                        </span>
                        <!-- <div class="rating"> -->
                        <?php getRatingStar($recipe['avgRating']); ?>
                        <!-- </div> -->
                        <p class="text-right right">By <?php echo $recipe['userName']; ?></p>
                      </h4>
                      <p class="recipe_description"><?php echo $recipe['description']; ?></p>
                      
                    </div>
                  </div>
                </div>

              <?php 
                  } 
                } else {
              ?>
                    <div class="well" >
                      <div class="media">
                      <div class="media-body">                      
                        <h4 class="recipe_description"><?php echo "<center>No recipe found</center>";; ?></h4>                         
                      </div>
                    </div>
                  </div>
              <?php                  
                }
              ?>

            

            
					</div>

          <?php } ?>

				</div>
			
			</div>



</div>



<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>

    <div class="modal_content_display">

        <form class="" action="includes/addRating.inc.php" method="post" enctype="multipart/form-data" >
          
          <div class="simple-login-container2">
            <h2>Add Rating</h2>
            </br>
            <div class="row">
                <div class="col-md-12 form-group">              

                    <!-- Rating Stars Box -->
                    <div class='rating-stars text-center'>
                      <ul id='stars'>
                        <li class='star' title='Poor' data-value='1'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Fair' data-value='2'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Good' data-value='3'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Excellent' data-value='4'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='WOW!!!' data-value='5'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                      </ul>
                    </div>
                    
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">          
                  <input name="ratedById" type="hidden" class="form-control" value="<?php echo $_SESSION['id']; ?>" placeholder="userId">
                  <input id="add_rating_recipe_idx" name="recipeId" type="hidden" class="form-control" value="0" >
                  <input id="rating_value" name="rating" type="hidden" class="form-control" value="0" placeholder="rating_value">
                  
                    <button class="btn btn-block btn-login" type="submit" name="submit">Submit</button>
                </div>
            </div>
        </div>
      </form>
    </div>
  </div>

</div>




<?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong!</p>";
      } 
    }
  
  ?>


<?php
  include_once 'footer.php';
?>




<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
// var btn = document.getElementById('fa');
var btn = document.querySelectorAll('.fa');
console.log(btn, '======>btn');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 

$(document.body).on('click', '.fa_rate', function() {
  // $('ul#stars li:eq()').click();
  
  var recipeId = $(this).closest('.well').attr('recipe_id');
  var myRating = $(this).closest('.well').attr('my_rating');


  if (myRating != 0) {
    $('ul#stars li:eq('+ (parseInt(myRating) - 1) +')').click();
  }
  
  $('#add_rating_recipe_idx').val(recipeId);
  console.log(recipeId, '======>recipeId');
  console.log(myRating, '======>myRating');
  
  if (<?php echo $_SESSION && isset($_SESSION['id']) ? true : false; ?>) {

    modal.style.display = "block";
  }
});

// btn.onclick = function() {
//   modal.style.display = "block";
// }

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}










$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    $('#rating_value').val(ratingValue);
    // $('#add_rating_recipe_id').val(ratingValue);

    
    // var msg = "";
    // if (ratingValue > 1) {
    //     msg = "Thanks! You rated this " + ratingValue + " stars.";
    // }
    // else {
    //     msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    // }
    // responseMessage(msg);
    
  });
  
  
});


// function responseMessage(msg) {
//   $('.success-box').fadeIn(200);  
//   $('.success-box div.text-message').html("<span>" + msg + "</span>");
// }
</script>




