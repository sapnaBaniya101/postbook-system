<?php
require('include/toppart.php');

?>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign Up</h5>
            <div class="signshow">
              <?php
              if (isset($_POST['submit'])) {
                # code...
                $name=$_POST['name'];
                $email=$_POST['email'];
                $phone=$_POST['phone'];
                $date=$_POST['date'];
                $password=md5($_POST['password']);
                $select="SELECT * FROM signup WHERE email='$email' AND phone='$phone'";
                $select_result= mysqli_query($conn,$select);
                $row=mysqli_num_rows($select_result);
                if ($row==1) {
                    # code...
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
                else {
                    # code...
                     $query2=" INSERT INTO signup (name,email,phone,date_of_birth,password)VALUES('$name','$email','$phone','$date','$password')";
                     $result=mysqli_query($conn,$query2);
                     if ($result) {
                    # code...
                          echo header("Location: login.php");
                      }
                       else {
                                ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                      <strong>Sign up unsucessfull</strong> 
                                    </div>
                                    
                                    <script>
                                      $(".alert").alert();
                                    </script>
                                <?php
                   
                            }
                 }
            
               
            }
            
            
            ?>

            

            </div>
            <form class="form-signin" action="#" method="POST" enctype="multipart/form-data">
            <div class="form-label-group">
                <input type="text" name="name" id="inputname" class="form-control" placeholder="Full Name" required autofocus>
                <label for="inputname">Full Name</label>
              </div>
              <div class="form-label-group">
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required >
                <label for="inputEmail">Email address</label>
              </div>
              <div class="form-label-group">
                <input type="tel" name="phone" id="inputPhoneNumber" class="form-control" placeholder="Phone Number" required >
                <label for="inputPhoneNumber">Phone Number</label>
              </div>
              <div class="form-label-group">
                <input type="date" name="date" id="inputDate" class="form-control" placeholder="" required >
                <label for="inputDate"></label>
              </div>

              <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              
              <button class="btn btn-lg btn-primary btn-block text-uppercase" value="submit" name="submit" type="submit">Sign Up</button>
              <h6 class="signup">Already Have a account <a class="link" href="login.php">Sign In</a></h6>
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


