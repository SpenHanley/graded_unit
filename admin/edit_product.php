<?php
if (!isset($_GET['id'])) {
  redirect("index.php");
}
$row = fetch_array(get_product($_GET['id']));
update_product();
?>
<div class="col-md-12">
   <div class="row">
      <h1 class="page-header">
         Edit Product
      </h1>
   </div>
   <form action="" method="post" enctype="multipart/form-data">
      <div class="col-md-8">
         <div class="form-group">
            <label for="product-title">Product Title </label>
            <input type="text" name="product_title" class="form-control" value="<?php echo $row['product_title'] ?>">
         </div>
         <div class="form-group">
            <label for="product-title">Product Description</label>
            <textarea name="product_description" id="" cols="30" rows="10" class="form-control" ><?php echo $row['product_description']; ?></textarea>
         </div>
         <div class="form-group">
            <label for="product-title">Short Description</label>
            <textarea name="short_desc" id="" cols="30" rows="10" class="form-control" ><?php echo $row['short_desc']; ?></textarea>
         </div>
         <div class="form-group row">
            <div class="col-xs-3">
               <label for="product-price">Product Price</label>
               <input type="number" name="product_price" class="form-control" size="60" value="<?php echo $row['product_price']; ?>">
            </div>
           <div class="col-xs-3">
              <label for="product-price">Product Quantity</label>
              <input type="number" name="product_quantity" class="form-control" size="60" value="<?php echo $row['product_quantity']; ?>">
           </div>
         </div>
      </div>
      <!--Main Content-->
      <!-- SIDEBAR-->
      <aside id="admin_sidebar" class="col-md-4">
         <div class="form-group">
            <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
         </div>
         <!-- Product Categories-->
         <div class="form-group">
            <label for="product-category">Product Category</label>
            <hr>
            <select name="product_category" id="" class="form-control">
               <option value="">Select Category</option>
               <?php get_categories_select_id($row['product_category_id']); ?>
            </select>
         </div>
         <!-- Product Image -->
         <div class="form-group">
            <label for="product-title">Product Image</label>
            <input type="file" name="file" value="<?php echo $row['product_image']; ?>">
         </div>
      </aside>
      <!--SIDEBAR-->
   </form>
</div>
<!-- /.container-fluid -->
