<?php
	require_once('../config.php');
        var_dump(is_writable('../uploads/products'));
	add_product();
?>
<div class="col-md-12">
   <div class="row">
      <h1 class="page-header">
         Add Product
      </h1>
   </div>
   <form action="" method="post" enctype="multipart/form-data">
      <div class="col-md-8">
         <div class="form-group">
            <label for="product-title">Product Title </label>
            <input type="text" name="product_title" class="form-control">
         </div>
         <div class="form-group">
            <label for="product-title">Product Description</label>
            <textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
         </div>
         <div class="form-group row">
            <div class="col-xs-3">
               <label for="product-price">Product Price</label>
               <input step="0.01" type="number" name="product_price" class="form-control" size="60">
            </div>
         </div>
         <div class="form-group">
            <label for="product-title">Short Description</label>
            <textarea name="short_desc" id="" cols="30" rows="2" class="form-control"></textarea>
         </div>
      </div>
      <!--Main Content-->
      <!-- SIDEBAR-->
      <aside id="admin_sidebar" class="col-md-4">
         <div class="form-group">
            <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
            <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
         </div>
         <!-- Product Categories-->
         <div class="form-group">
            <label for="product-title">Product Category</label>
            <select name="product_category_id" id="" class="form-control">
               <option value="">Select Category</option>
			   <?php get_categories_select(); ?>
            </select>
         </div>
         <!-- Product Brands-->
         <div class="form-group">
            <label for="product-title">Product Quantity</label>
			<input type="text" name="product_quantity" class="form-control" />
         </div>
         <!-- Product Tags -->
		 <!--
			 <div class="form-group">
				<label for="product-title">Product Keywords</label>
				<hr>
				<input type="text" name="product_tags" class="form-control">
			 </div>
		 -->
         <!-- Product Image -->
         <div class="form-group">
            <label for="product-title">Product Image</label>
            <input type="file" name="file" id='img-src'>
			<br />
			<img class='thumbnail' id='img-target' style="max-width: 300px;"/>
         </div>
      </aside>
      <!--SIDEBAR-->
   </form>
</div>
<!-- /.container-fluid -->
<script>
function showImage(src, target) {
	var fr = new FileReader();
	fr.onload = function (e) { target.src = this.result; };
	src.addEventListener("change", function() {
		if (fr.readAsDataUrl) {
			fr.readAsDataUrl(src.files[0]);
		} else if (fr.readAsDataURL) {
			fr.readAsDataURL(src.files[0]);
		}
	});
}

var src = document.getElementById('img-src');
var target = document.getElementById('img-target');

showImage(src, target);
</script>
