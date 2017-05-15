<?php
   require_once('config.php');
   require_once('cart.php');
   include('includes/header.php');
   echo report();
   //session_destroy();
   ?>
<!-- Page Content -->
<div class="container">
   <h1 class='text-center' style='text-transform: uppercase;'>Thank You</h1>
</div>
<!--Main Content-->
<?php
   include('includes/footer.php');
   ?>