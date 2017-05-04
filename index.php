<?php 
	require_once("config.php");
	include("includes/header.php");
?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
		
			<?php
				include("includes/side_nav.php");
			?>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <?php
						include('includes/slider.php');
						?>
                    </div>

                </div>

                <div class="row">
				<?php get_books(); ?>
                </div> <!-- images end here -->

            </div>

        </div>

    </div>
    <!-- /.container -->

 <?php
 include("includes/footer.php");
 ?>
