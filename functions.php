<?php
function redirect($location) {
	header("Location: $location");
}

/*
To call the global connection within a function we need to make it global
*/
function query($sql) {
	global $connection;
	
	return mysqli_query($connection, $sql);
}

function confirm($result) {
	global $connection;
	
	if (!$result) {
		die("QUERY FAILED ".mysqli_error($connection));
	}
}

function escape_string($string) {
	global $connection;
	
	/* Use escape string to help prevent sql injection attacks */
	return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result) {
	return mysqli_fetch_array($result);
}

function get_products_in_dash() {
	$query = query("SELECT * FROM products");
	confirm($query);
	
	while($row = fetch_array($query)) {
		$product = <<<DELIMITER
			<tr>
				<td>{$row['product_id']}</td>
				<td>{$row['product_title']}</td>
				<td>
					<img style="width:150px;height:50px;" src='uploads/{$row['product_image']}' alt='Image of {$row['product_title']}'/>
				</td>
				<td>{$row['product_category_id']}</td>
				<td>&pound;{$row['product_price']}</td>
				<td>{$row['product_quantity']}</td>
				<td>
					<a class='btn btn-info' href='index.php?edit_p&id={$row['product_id']}' >
						<span class="glyphicon glyphicon-edit"></span>
					</a>
					<a class='btn btn-danger' href='delete_product.php?id={$row['product_id']}'>
						<span class="glyphicon glyphicon-remove"></span>
					</a>
				</td>
			</tr>
DELIMITER;
		echo $product;
	}
}

function get_products() {
	$query = query("SELECT * FROM products");
	confirm($query);
	
	while($row = fetch_array($query)) {
		$product = 	<<<DELIMITER
						<div class="col-sm-4 col-lg-4 col-md-4">
							<div class="thumbnail">
								<a href="item.php?id={$row['product_id']}">
									<img src="{$row['product_image']}" alt="">
								</a>
								<div class="caption">
									<h4 class="pull-right">{$row['product_price']}</h4>
									<h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
									</h4>
									<p>{$row['product_description']}</p>
								</div>
								<div class="ratings">
									<p class="pull-right">15 reviews</p>
									<p>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
										<span class="glyphicon glyphicon-star"></span>
									</p>
								</div>
								<a class="btn btn-primary" href="cart.php?add={$row['product_id']}">Add to cart</a>
							</div>
						</div>
						
DELIMITER;
		echo $product;
	}
}

function get_categories() {
	$query = query("SELECT * FROM categories");
	confirm($query);
	
	while($row = fetch_array($query)) {
		$categories_links = <<<DELIMITER
		<a href="category.php?id={$row['cat_id']}" class="list-group-item">{$row['cat_title']}</a>
DELIMITER;
		echo $categories_links;
	}
}

function get_categories_select() {
	$query = query("SELECT * FROM categories");
	confirm($query);
	
	while($row = fetch_array($query)) {
		$category = <<<DELIMITER
		<option value={$row['cat_id']}">{$row['cat_title']}</option>
DELIMITER;
		echo $category;
	}
}

function get_products_in_cat_page() {
	$query = query("SELECT * FROM products WHERE product_category_id=".escape_string($_GET['id'])."");
	confirm($query);
	
	while($row = fetch_array($query)) {
		$product = 	<<<DELIMITER
						<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
						
DELIMITER;
		echo $product;
	}
}


function get_products_in_shop_page() {
	$query = query("SELECT * FROM products");
	confirm($query);
	
	while($row = fetch_array($query)) {
		$product = 	<<<DELIMITER
						<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
						
DELIMITER;
		echo $product;
	}
}

function login_user() {
	// Check if the submit button has been pressed
	if (isset($_POST['submit'])) {
		// Create the variables and assign values form the username and password fields in the login form
		$username = escape_string($_POST['username']);
		$password = escape_string($_POST['password']);
		$_SESSION['username'] = $username;
		// Check them against the values held in the database
		$query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'");
		confirm($query);
		// Use the num_rows function to work out whether there is a match or not
		if (mysqli_num_rows($query) == 0) {
			set_message("Your username or password is incorret. Please try again.");
			redirect('login.php');
		} else {
			redirect('admin');
		}
	}
}

function set_message($msg) {
	if (!empty($msg)) {
		$_SESSION['message'] = $msg;
	} else {
		$msg = "";
	}
}

function display_message() {
	if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function send_message() {
	if (isset($_POST['submit'])) {
		echo 'It works';
	}
}

function last_id() {
	global $connection;
	return mysqli_insert_id($connection);
}

function display_orders() {
	$query = query("SELECT * FROM orders");
	confirm($query);
	
	while ($row = fetch_array($query)) {
		$orders = <<<DELIMITER
			<tr>
				<td>{$row['order_id']}</td>
				<td>{$row['order_amount']}</td>
				<td>{$row['order_transaction']}</td>
				<td>{$row['order_currency']}</td>
				<td>{$row['order_status']}</td>
				<td><a class="btn btn-danger" href="delete_order.php?id={$row['order_id']}><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
DELIMITER;
		echo $orders;
	}
}

function add_product() {
	if (isset($_POST['publish'])) {
		$product_title = escape_string($_POST['product_title']);
		$product_category_id = escape_string($_POST['product_category_id']);
		$product_price = escape_string($_POST['product_price']);
		$product_description = escape_string($_POST['product_description']);
		$short_desc = escape_string($_POST['short_desc']);
		$product_quantity = escape_string($_POST['product_quantity']);
		$product_image = escape_string($_FILES['file']['name']);
		$image_temp_location = escape_string($_FILES['file']['tmp_name']);
		move_uploaded_file($_FILES['file']['tmp_name'], "uploads/".$product_image);
		$query = query("INSERT INTO products(product_title, product_category_id, product_price, product_description, short_desc, product_quantity, product_image) VALUES ('{$product_title}','{$product_category_id}','{$product_price}','{$product_description}','{$short_desc}','{$product_quantity}','{$product_image}')");
		$last_id = last_id();
		confirm($query);
		set_message("New product with id {$last_id} Just Added");
		//redirect('index.php?products');
	}
}
?>