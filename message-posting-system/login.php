<?php
require('include/toppart.php');
session_start();

?>

  <div class="container">

    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <div class="logshow">
            <?php

if (isset($_POST['submit'])) {
  # code...
  $email=$_POST['email'];
  $password=md5($_POST['password']) ;

  $query="SELECT * FROM signup WHERE email='$email' AND password='$password'";
  $result=mysqli_query($conn,$query);
  $data=mysqli_fetch_array($result);
  $count=mysqli_num_rows($result);
  $id=$data['user_id'];
  if ($count==1) {
    $_SESSION['email']=$email;
    $_SESSION['user']=$data['user_id'];
      # code...
      ?>
      <meta http-equiv="refresh" content="0; URL=dashboard.php?msg=csuccess?id=<?php echo $id ?>" />
    <?php
  }
  else {
      
      ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>User Invalid</strong> 
      </div>
      
      <script>
        $(".alert").alert();
      </script>
<?php
  }
}

?>

            </div>
            <form class="form-signin" action="#" method="POST" enctype="multipart/form-data">
              <div class="form-label-group">
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" name="submit" value="submit" type="submit">Sign in</button>
              <h6 class="signup">Create a New Account <a class="link" href="signup.php">Sign Up</a></h6>
              <hr class="my-4">

              
            </form>
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

