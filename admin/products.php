<h1 class="page-header">
   All Products
</h1>
<h3><?php display_message(); ?></h3>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Title</th>
			<th>Image</th>
			<th>Category</th>
			<th>Price</th>
			<th>Quantity</th>
			<th></th>
		</tr>
    </thead>
    <tbody>
		<?php get_books_in_dash(); ?>
	</tbody>
</table>
