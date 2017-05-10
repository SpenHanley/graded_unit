<div class="col-md-12">
   <div class="row">
      <h1 class="page-header">
         Edit Product
      </h1>
   </div>
   <form action="" method="post" enctype="multipart/form-data">
      <div class="col-md-8">
         <div class="form-group">
            <label for="book-title">Book Title </label>
	    <select name="book_title" class="form-control">
		<option value="">Select One...</option>
	    </select>
         </div>
         <div class="form-group">
            <label for="book-description">Book Description</label>
            <textarea name="book_description" id="" cols="30" rows="10" class="form-control"></textarea>
         </div>
         <div class="form-group row">
            <div class="col-xs-3">
               <label for="book-price">Book Price</label>
               <input type="number" name="book_price" class="form-control" size="60">
            </div>
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
            <label for="book-genre">Book Genre</label>
            <hr>
            <select name="book_genre" id="book-genre" class="form-control">
               <option value="">Select Category</option>
            </select>
         </div>
         <!-- Product Image -->
         <div class="form-group">
	    <label for="book-image">Book Image</label>
            <input type="file" name="book_image">
         </div>
      </aside>
      <!--SIDEBAR-->
   </form>
</div>
<!-- /.container-fluid -->
