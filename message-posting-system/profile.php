<?php
session_start();
require('connection/server.php');
require('include/toppart.php');
require('include/sidebar.php');


require('include/nav.php');
?>
<body >
<div class="page">
 <?php


if (isset($_SESSION['user'])) {
    # code...
    $user=$_SESSION['user'];
}
    ?>

<div class="leftbox">
    <div class="title">
           <h1 class="name text-white">Simran Baniya </h1>
          <hr class="horiz my-4">
          <button onclick="postFunction()" type="button" name="post" id="post" class="btn-profile btn-primary active" btn-lg btn-block>Post</button>
          <button onclick="updateFunction()" type="button" name="updatebtn" id="updatebtn" class="btn-update btn-primary active" btn-lg btn-block>Update</button>
    </div>
          <div class="image bg-dark" style="border-radius:100px;position:absolute;display:inline-block;margin-left:48rem; margin-top:-100px; height:200px; width:200px;z-index:1; ">
          <?php
          $displayquery="SELECT * FROM signup WHERE user_id=$user";
          $displayresult=mysqli_query($conn,$displayquery);
          while ($row=mysqli_fetch_array($displayresult)) {
            # code...
            ?>
             <img class="profileimage" src="<?php echo $row['image']; ?>" style="border-radius:100px; z-idex:2;" alt="" srcset=""  height="100%" width="100%">
      
            <?php
      
          }

          ?>
          <?php
if (isset($_POST['submit'])) {
  # code...
  $files=$_FILES['file'];
  
  
  $filename=$files['name'];
  $fileerror=$files['error'];
  $filetmp=$files['tmp_name'];
  $fileext=explode('.',$filename);
  $filecheck=strtolower(end($fileext));
  $filestored=array('png','jpg','jpeg');
  if (in_array($filecheck,$filestored)) {
    # code...
    $destinationfile='image/'.$filename;
    move_uploaded_file($filetmp,$destinationfile);
    $query4="UPDATE signup SET image='$destinationfile' WHERE user_id=$user";
    $result4=mysqli_query($conn,$query4);
    
  }
  

}

?>
          <form class="form-signin" action="#" method="POST" enctype="multipart/form-data">
            <div class="form-label-group">
                <input type="file" name="file" id="file" class="form-control" style="display:none;visibility:none;" >
                <label for="file"><i class="fas fa-camera" style="position:absolute;font-size:27px;margin-top:-80px;color:black; margin-left:105px;cursor:pointer;"></i></label>
                
              </div>
              <button type="submit" name="submit" style="position:absolute;margin-top:-74px; margin-left:150px;background-color:transparent;border:none;">Edit</button>
               
               </form>



          </div>
         


    <div class="postshow" id="postshow" name="postshow">
    <?php
    $query = "SELECT signup.name,post.postup
    FROM signup,post 
    WHERE  signup.user_id=post.user_id AND post.user_id=$user ORDER BY posted_at DESC";
    $result=mysqli_query($conn,$query);
    if ($result) {
        # code...
        while ($data=mysqli_fetch_array($result)) {
            # code...
            ?>
           <div class="post-card text-left text-grey  " style="margin:auto ">
             
             <div class="card-body">
               <h4 class="card-title"><?php echo $data['name']; ?></h4>
               <p class="card-text"><?php echo $data['postup']; ?></p>
             </div>
           </div>
            <?php
        }


    }
    else {
        echo "Nothing to show";
    }
    ?>



    </div>

<div class="update" id="update">
    <?php
$query2="SELECT * FROM signup WHERE user_id=$user";
$result2=mysqli_query($conn,$query2);
$data1=mysqli_fetch_array($result2);




?>
    <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Update</h5>
            <div class="divshow">
            <?php
            if (isset($_POST['submit'])) {
                # code...
                $name1=$_POST['name'];
                $email1=$_POST['email'];
                $phone1=$_POST['phone'];
                $date1=$_POST['date'];
            $query3="UPDATE signup SET name='$name1', email='$email1',phone='$phone1',date_of_birth='$date1' WHERE user_id=$user";
            $result3=mysqli_query($conn,$query3);
            if ($result3) {
                # code...
                ?>
               <div class="alert alert-success alert-dismissible fade show ml-1" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
                 <strong>Updated Successfully</strong> 
               </div>
               
               <script>
                 $(".alert").alert();
               </script>
               <?php
            }
            else
            {
                ?>
                <div class="alert alert-warning alert-dismissible fade show ml-1" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Updated Unsuccessfully</strong> 
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
                <input type="text" name="name" id="inputname" class="form-control" value="<?php echo $data1['name']; ?>" placeholder="Full Name" required autofocus>
                <label for="inputname">Full Name</label>
              </div>
              <div class="form-label-group">
                <input type="email" name="email" id="inputEmail" class="form-control" value="<?php echo $data1['email']; ?>" placeholder="Email address" required >
                <label for="inputEmail">Email address</label>
              </div>
              <div class="form-label-group">
                <input type="tel" name="phone" id="inputPhoneNumber" class="form-control" value="<?php echo $data1['phone']; ?>" placeholder="Phone Number" required >
                <label for="inputPhoneNumber">Phone Number</label>
              </div>
              <div class="form-label-group">
                <input type="date" name="date" id="inputDate" class="form-control" value="<?php echo $data1['date_of_birth']; ?>" placeholder="" required >
                <label for="inputDate"></label>
              </div>

            
              <button class="btn btn-lg btn-primary btn-block text-uppercase" value="submit" id="btn" name="submit" type="submit">Update</button>
              
              <hr class="my-4">

              
            </form>
          </div>
        </div>
      </div>
    </div>
   
  </div>

    </div>
<script>
var post=document.getElementById("postshow");
function postFunction() {
    if (post.style.display==="none") {
        post.style.display="block";
        
    }
    else
    {
        post.style.display="none";
    }
}
var update=document.getElementById("update");
function updateFunction() {
    if (update.style.display==="none") {
        update.style.display="block";
        
    }
    else
    {
        update.style.display="none";
    }
}
</script>

</div>
</div>
<?php
require('include/bottom.php');
?>

</body>
</html>
