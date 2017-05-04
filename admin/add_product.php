<?php
	require_once('../config.php');
	add_book();
?>
<div class="col-md-12">
   <div class="row">
      <h1 class="page-header">
         Add Book
      </h1>
   </div>
   <form action="add_book.php" method="post" enctype="multipart/form-data">
      <div class="col-md-8">
         <div class="form-group">
            <label for="book-title">Book Title </label>
            <input type="text" name="book_title" class="form-control">
         </div>
         <div class="form-group">
            <label for="book-title">Book Description</label>
            <textarea name="book_description" id="" cols="30" rows="10" class="form-control"></textarea>
         </div>
         <div class="form-group row">
            <div class="col-xs-3">
               <label for="book-price">Book Price</label>
               <input type="number" name="book_price" class="form-control" size="60">
            </div>
         </div>
         <div class="form-group">
            <label for="book-title">Short Description</label>
            <textarea name="short_desc" id="" cols="30" rows="2" class="form-control"></textarea>
         </div>
         <div class='form-group'>
            <label for='author'>Author</label>
            <input type='text' name='author' class='form-control'>
         </div>
      </div>
      <!--Main Content-->
      <!-- SIDEBAR-->
      <aside id="admin_sidebar" class="col-md-4">
         <div class="form-group">
            <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
            <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
         </div>
         <!-- book Categories-->
         <div class="form-group">
            <label for="book-title">Book Genre</label>
            <select name="genre_id" id="" class="form-control">
               <option value="">Select Genre</option>
			   <?php get_genres_select(); ?>
            </select>
         </div>
         <!-- book Brands-->
         <div class="form-group">
            <label for="book-title">Book Quantity</label>
			<input type="text" name="book_quantity" class="form-control" />
         </div>
         <!-- book Tags -->
		 <!--
			 <div class="form-group">
				<label for="book-title">book Keywords</label>
				<hr>
				<input type="text" name="book_tags" class="form-control">
			 </div>
		 -->
         <!-- book Image -->
         <div class="form-group">
            <label for="book-title">Book Image</label>
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
