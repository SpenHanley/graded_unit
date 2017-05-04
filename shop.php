<?php 
	include("includes/header.php");
?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
			<h1>Shop</h1>
        </header>

        <hr>

        <!-- Page Features -->
        <div class="row text-center">

            
			<?php
			get_products_in_shop_page();
			?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
		<?php include('includes/footer.php') ?>
