<?php
if (!isset($_GET['id'])) {
  redirect('index.php');
}

$row = fetch_array(get_user($_GET['id']));
var_dump($row);
?>
<div class="col-md-12">
  <div class="row">
      <h1 class="page-header">
        Edit User
      </h1>
   </div>
   <form action="" method="post" enctype="multipart/form-data">
      <div class="col-md-8">
         <div class="form-group">
            <label for="product-title">First Name</label>
            <input type="text" name="product_title" class="form-control" value="<?php echo $row['first_name']; ?>">
         </div>
         <div class="form-group">
            <label for="product-title">Last Name</label>
            <input  type="text" name="product_description" id="" class="form-control" value="<?php echo $row['last_name'] ?>">
         </div>
         <div class="form-group">
               <label for="product-price">Username</label>
               <input type="text" name="product_price" class="form-control" size="60" value="<?php echo $row['username'] ?>">
         </div>
      </div>
      <aside id="admin_sidebar" class="col-md-4">
         <div class="form-group">
            <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
            <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
         </div>
         <div class="form-group">
            <label for="product-title">User Image</label>
            <input type="file" name="file">
         </div>
      </aside>
   </form>
</div>
