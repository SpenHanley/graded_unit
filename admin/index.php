<?php
	include('../config.php');
	include('includes/header.php');
	if (!isset($_SESSION['username']))
	{
		redirect('../');
	}
?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<?php
					//if ($_SERVER['REQUEST_URI'] == "/Studentwork/hanleys/admin/" || $_SERVER['REQUEST_URI'] == "/Studentwork/hanleys/admin/index.php") {
						include('includes/admin_content.php');
					//}
					if (isset($_GET['orders'])) {
						include('orders.php');
					} elseif (isset($_GET['add_p'])) {
						include('add_product.php');
					} elseif (isset($_GET['categories'])) {
						include('categories.php');
					} elseif (isset($_GET['products'])) {
						include('products.php');
					} elseif (isset($_GET['users'])) {
						include('users.php');
					} elseif (isset($_GET['edit_p'])) {
						include('edit_product.php');
					}
				?>
            </div>
            <!-- /.container-fluid -->
<?php
include('includes/footer.php');
?>
