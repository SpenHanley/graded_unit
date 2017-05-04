<div class="col-lg-12">
   <h1 class="page-header">
      Users
   </h1>
   <p class="bg-success">
      <?php echo $message; ?>
   </p>
   <a href="add_user.php" class="btn btn-primary">Add User</a>
   <div class="col-md-12">
      <table class="table table-hover">
         <thead>
            <tr>
               <th>Id</th>
               <th>Photo</th>
               <th>Username</th>
               <th>First Name</th>
               <th>Last Name </th>
            </tr>
         </thead>
         <tbody>
            <?php
                get_users_in_dash();
            ?>
         </tbody>
      </table>
      <!--End of Table-->
   </div>
</div>
