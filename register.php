<?php
require('config.php');
include('includes/header.php');
?>
    <!-- Page Content -->
    <div class="container">
      <header>
        <h1 class="text-center">Register</h1>
        <h2 class="text-center"><?php display_message(); ?></h2>
        <div class="col-sm-4 col-sm-offset-5">
         <form class="" action="<?php register_user(); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group"><label for="">
              First Name<input type="text" name="first_name" class="form-control"></label>
            </div>
            <div class="form-group"><label for="">
              Last Name<input type="text" name="last_name" class="form-control"></label>
            </div>
            <div class="form-group"><label for="">
              Username<input type="text" name="username" class="form-control"></label>
            </div>
            <div class="form-group"><label for="password">
              Password<input type="password" name="password" class="form-control"></label>
            </div>
            <div class="form-group"><label for="">
              Image<input type="file" name="file" class="form-control"></label>
            </div>
            <div class="form-group">
              <input type="submit" name="register" class="btn btn-primary" >
            </div>
         </form>
          </div>
    </header>
        </div>
    </div>
    <!-- /.container -->

<?php include('includes/footer.php'); ?>
