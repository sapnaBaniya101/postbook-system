<?php
session_start();
require('connection/server.php');
require('include/toppart.php');
require('include/sidebar.php');
require('include/nav.php');

?>
<div class="change-pass">
  <?php
  if (isset($_SESSION['user'])) {
    # code...
    $user=$_SESSION['user'];
  }

  ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Change Password </h5>
            <div class="messageshow">
               <?php

              if (isset($_POST['submit'])) {
              # code...
              $existing=md5($_POST['existing']);
              $new=md5($_POST['new']);
              $confirm=md5($_POST['confirm']);
              $query="SELECT * FROM signup WHERE user_id=$user AND password='$existing'";
              $result=mysqli_query($conn,$query);
              $count=mysqli_num_rows($result);
             
              if ($result) {
                # code...
                if ($new==$confirm) {
                  # code...
                  $query1="UPDATE signup SET password='$new' WHERE user_id=$user";
                  $result1=mysqli_query($conn,$query1);
                  if ($result1) {
                    # code...
                    ?>
                    <div class="alert alert-sucess text-success alert-dismissible fade show ml-5" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Update successfull </strong> 
                    </div>
                    
                    <script>
                      $(".alert").alert();
                    </script>
                    
                    <?php
                  }
                  else {
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show ml-5" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>update Unsuccesfull</strong> 
                    </div>
                    
                    <script>
                      $(".alert").alert();
                    </script>
                    
                    <?php
                    
                  }
                  

                }
                else {
                  ?>
                <div class="alert alert-warning alert-dismissible fade show ml-5" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>New password doesnot match confirm password</strong> 
                </div>
                
                <script>
                  $(".alert").alert();
                </script>
                
                <?php
                  
                }
               
              }
              else {
                ?>
                <div class="alert alert-warning alert-dismissible fade show ml-4" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Password doesnot match with your current password</strong> 
                </div>
                
                <script>
                  $(".alert").alert();
                </script>
                
                <?php
              }
              
            }

            
            ?>
            </div>
            <form class="form-signin" action="#" method="post" enctype="multipart/form-data">
              <div class="form-label-group">
                <input type="password" name="existing" id="inputpassword" class="form-control" placeholder="Existing Password" required autofocus>
                <label for="inputpassword">Existing Password</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="new" id="inputNewPassword" class="form-control" placeholder=" New Password" required>
                <label for="inputNewPassword">New Password</label>
              </div>
              <div class="form-label-group">
                <input type="password" name="confirm" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" required>
                <label for="inputConfirmPassword">Confirm Password</label>
              </div>
              
              <button class="btn btn-lg btn-primary btn-block text-uppercase" value="submit" name="submit" type="submit">Submit</button>
              
              <hr class="my-4">
      

              
            </form>
           
          </div>
        </div>
      </div>
    </div>
    
  </div>
  </div>
  <?php
        require('include/bottom.php');

        ?>
        </body>

        </html>
