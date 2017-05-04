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

function get_books_in_dash() {
	$query = query("SELECT * FROM books");
	confirm($query);
	
	while($row = fetch_array($query)) {
		$book = <<<DELIMITER
			<tr>
				<td>{$row['book_id']}</td>
				<td>{$row['book_title']}</td>
				<td>
					<img style="width:150px;height:50px;" src='uploads/{$row['book_image']}' alt='Image of {$row['book_title']}'/>
				</td>
				<td>{$row['book_category_id']}</td>
				<td>&pound;{$row['book_price']}</td>
				<td>{$row['book_quantity']}</td>
				<td>
					<a class='btn btn-info' href='index.php?edit_p&id={$row['book_id']}' >
						<span class="glyphicon glyphicon-edit"></span>
					</a>
					<a class='btn btn-danger' href='delete_book.php?id={$row['book_id']}'>
						<span class="glyphicon glyphicon-remove"></span>
					</a>
				</td>
			</tr>
DELIMITER;
		echo $book;
	}
}

function get_books() {
	$query = query("SELECT * FROM books");
	confirm($query);
	
	while($row = fetch_array($query)) {
		$book = 	<<<DELIMITER
						<div class="col-sm-4 col-lg-4 col-md-4">
							<div class="thumbnail">
								<a href="item.php?id={$row['book_id']}">
									<img src="{$row['book_image']}" alt="">
								</a>
								<div class="caption">
									<h4 class="pull-right">{$row['book_price']}</h4>
									<h4><a href="item.php?id={$row['book_id']}">{$row['book_title']}</a>
									</h4>
									<p>{$row['book_description']}</p>
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
								<a class="btn btn-primary" href="cart.php?add={$row['book_id']}">Add to cart</a>
							</div>
						</div>
						
DELIMITER;
		echo $book;
	}
}

function get_genres() {
	$query = query("SELECT * FROM genres");
	confirm($query);
	
	while($row = fetch_array($query)) {
		$genres_links = <<<DELIMITER
		<a href="genre.php?id={$row['genre_id']}" class="list-group-item">{$row['genre_name']}</a>
DELIMITER;
		echo $genres_links;
	}
}

function get_genres_select() {
	$query = query("SELECT * FROM genres");
	confirm($query);
	
	while($row = fetch_array($query)) {
		$category = <<<DELIMITER
		<option value={$row['genre_id']}">{$row['genre_name']}</option>
DELIMITER;
		echo $category;
	}
}

function get_books_in_genre_page() {
	$query = query("SELECT * FROM books WHERE genre_id=".escape_string($_GET['id'])."");
	confirm($query);
	
	while($row = fetch_array($query)) {
		$book = 	<<<DELIMITER
						<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['book_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['book_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
						
DELIMITER;
		echo $book;
	}
}


function get_books_in_shop_page() {
	$query = query("SELECT * FROM books");
	confirm($query);
	
	while($row = fetch_array($query)) {
		$book = 	<<<DELIMITER
						<div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['book_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['book_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
						
DELIMITER;
		echo $book;
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
		    while ($row = fetch_array($query)) {
		        $_SESSION['display_name'] = $row['first_name'].' '.$row['last_name'];
		    }
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
				<td>{$row['customer_id']}</td>
				<td><a class="btn btn-danger" href="delete_order.php?id={$row['order_id']}><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
DELIMITER;
		echo $orders;
	}
}

function add_book() {
	if (isset($_POST['publish'])) {
		$book_title = escape_string($_POST['book_title']);
		$book_category_id = escape_string($_POST['book_category_id']);
		$book_price = escape_string($_POST['book_price']);
		$book_description = escape_string($_POST['book_description']);
		$short_desc = escape_string($_POST['short_desc']);
		$book_quantity = escape_string($_POST['book_quantity']);
		$book_image = escape_string($_FILES['file']['name']);
		$image_temp_location = escape_string($_FILES['file']['tmp_name']);
		move_uploaded_file($_FILES['file']['tmp_name'], "uploads/books/".$book_image);
		$query = query("INSERT INTO books(book_title, genre_id, book_price, description, desc, book_quantity, cover_art) VALUES ('{$book_title}','{$book_category_id}','{$book_price}','{$book_description}','{$short_desc}','{$book_quantity}','{$book_image}')");
		$last_id = last_id();
		confirm($query);
		set_message("New book with id {$last_id} Just Added");
		//redirect('index.php?books');
	}
}

function get_users_in_dash() {
    $query = query('SELECT * FROM users');
    
    confirm($query);
    
    while ($row = fetch_array($query)) {
        $users = <<<DELIMITER
			<tr>
				<td>{$row['user_id']}</td>
				<td>
					<img style="width:50px;height:50px;" src='../uploads/users/{$row['user_image']}' alt='Image of {$row['username']}'/>
				</td>
				<td>{$row['username']}</td>
				<td>{$row['first_name']}</td>
				<td>{$row['last_name']}</td>
			</tr>
DELIMITER;
        echo $users;
    }
}

?>
