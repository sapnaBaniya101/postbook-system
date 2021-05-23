
<?php
session_start();
require('connection/server.php');
require('include/toppart.php');
require('include/sidebar.php');
require('include/nav.php');
if (isset($_SESSION['user'])) {
   # code...
   $user=$_SESSION['user'];
}

?>
<body>


<div class="left" style="display:inline-block;">
 <div class="friend" style="height:16rem;display:flex;width:70%;justify-content:space-between;background-color:transparent;max-width:fit-content;overflow:auto;
      margin-left:19rem;position:absolute;top:0;z-index:2;margin-top:-38rem;right:0;left:0;padding:20px;">
        
  <?php
        $select_query1 = "SELECT name,image
        FROM signup";
        $result2 = mysqli_query($conn,$select_query1);
        ?>
         <?php
       while ($data1 = mysqli_fetch_array($result2)) {
          # code...
          if ($data1['image']=="") {
            # code...
            ?>
            <div class="card" style="max-width:200px;margin-right:20px;border-radius:30px">
           <img class="card-img-top text-center" style="border-radius:30px" height="150px" width="100px" src="image/profile.png" alt="No Image">
          <div class="card-body">
          <h4 class="card-title" style="text-align:center"><?php echo $data1['name']; ?></h4>
    
          </div>
         </div>
         <?php
          }
          else {
            ?>
            <div class="card"style="max-width:200px;margin-right:20px;border-radius:30px" >
           <img class="card-img-top" style="border-radius:30px" height="150px" width="50%" src="<?php echo $data1['image']; ?>" alt="">
          <div class="card-body">
          <h4 class="card-title"><?php echo $data1['name']; ?></h4>
    
          </div>
         </div>
         <?php
          }
          ?>
         
         <?php
       }?>

  </div>
  <div class="posting border-light" style="margin-left:25rem;margin-top:-21rem" >
  
      <div class="card-body" style="">
         <h4 class="card-title text-white text-center">POST</h4>
         <?php


   
         if (isset($_POST['postup'])) {
   # code...
        $post=$_POST['post'];
        if ($post=="") {
      # code...
      ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>Post cannot be empty</strong> 
      </div>
      
      <script>
        $(".alert").alert();
      </script>
  <?php

   }
   else {
      # code...
      $query2="INSERT INTO post(postup,user_id) VALUES('$post','$user')";
      $result2=mysqli_query($conn,$query2);
   
   if ($result2 ) {
      # code...
      ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong>Post inserted sucessfully</strong> 
      </div>
      
      <script>
        $(".alert").alert();
      </script>
  <?php

   }
   else {
      ?>
      <div class="alert alert-warning alert-dismissible fade show" style="margin-top:-100px; position:absolute;z-index:2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <strong><?php echo $result2; ?>Post insertion unsucessfull</strong> 
      </div>
      
      <script>
        $(".alert").alert();
      </script>
  <?php

      
   }
   }

   
}






?>

    
        <form action="#" method="post"enctype="multipart/form-data">
            <div class="form-group">
                <label class="label text-white" for="text">What's on your mind?</label><br>
                <textarea class="text " name="post" id="" placeholder="What's on your mind, " ></textarea>
            </div>
            <button type="submit" name="postup" value="postup" class="btn btn-primary">Post</button>
        </form>
      </div>
      
</div>
<div class="dashboard d-block justify-content-center" style="margin-bottom:100px; position:absolute;margin-top:20px">
      <?php
        $select_query = "SELECT signup.name,post.postup,post.posted_at,post.post_id,signup.image
        FROM signup,post 
        WHERE  signup.user_id=post.user_id ORDER BY posted_at DESC";
        $result1 = mysqli_query($conn,$select_query);
        ?>
        
        <?php
       while ($data = mysqli_fetch_array($result1)) {
          # code...
          $postid=$data['post_id'];
          ?>
          <div class="post-card text-left text-grey  " style="">
           
            <div class="card-body" style="border-top-right-radius: 20px;">
            <?php
            if ($data['image']=="") {
              # code...
              ?>
               <img class="profileimage" src="image/profile.png" style="border-radius:100px; z-idex:2;" alt="" srcset=""  height="30px" width="30px">

              <?php
            }
            else {
              # code...
              ?>
               <img class="profileimage" src="<?php echo $data['image']; ?>" style="border-radius:100px; z-idex:2;" alt="no" srcset=""  height="30px" width="30px">
              <?php
            }
          ?>
            
              <h4 class="card-title"> <?php echo $data['name'];?></h4>
              <p class="card-title-text"><?php echo $data['posted_at'];?> </p>
              <p class="card-text"><?php echo $data['postup']; ?></p>
             
              
            
            
            
          </div>
          </div>
          <?php

       }
       ?>
       </div> 
        
           
        
      ?>
   

</div>
<?php
require('include/bottom.php');
?>
</body>
</html>