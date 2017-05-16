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
                                        <img style="width:110px;height:150px;" src='../uploads/{$row['product_image']}' alt='Image of {$row['product_title']}'/>
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
                                                                        <img src="uploads/{$row['product_image']}" alt="">
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

function get_categories_in_dash() {
  $query = query("SELECT * FROM categories");
  confirm($query);

  while ($row = fetch_array($query)) {
    $categories = <<<DELIMITER
                <tr>
                                <td>{$row['cat_id']}</td>
                                <td>{$row['cat_title']}</td>
                </tr>
DELIMITER;
    echo $categories;
  }
}

function get_categories_select() {
  $query = query("SELECT * FROM categories");
  confirm($query);

  while($row = fetch_array($query)) {
    $category = <<<DELIMITER
                <option value="{$row['cat_id']}">{$row['cat_title']}</option>
DELIMITER;
    echo $category;
  }
}

function get_categories_select_id($id) {
  $query = query("SELECT * FROM categories");
  confirm($query);

  while($row = fetch_array($query)) {
    $id = escape_string($id);
    $category = "";
    if ($row['cat_id'] == $id) {
      $category = <<<DELIMITER
                <option value="{$row['cat_id']}" selected>{$row['cat_title']}</option>
DELIMITER;
    } else {
      $category = <<<DELIMITER
                <option value="{$row['cat_id']}">{$row['cat_title']}</option>
DELIMITER;
    }
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
                    <img src="uploads/{$row['product_image']}" alt="">
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
      while ($row = fetch_array($query)) {
        if ($row['admin'] == 1) {
          $_SESSION['admin'] = 1;
        }
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
                                <td><a class="btn btn-danger" href="delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
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
    move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/products/".$product_image);
    $query = query("INSERT INTO products(product_title, product_category_id, product_price, product_description, short_desc, product_quantity, product_image) VALUES ('{$product_title}','{$product_category_id}','{$product_price}','{$product_description}','{$short_desc}','{$product_quantity}','{$product_image}')");
    $last_id = last_id();
    confirm($query);
    set_message("New product with id {$last_id} Just Added");
    //redirect('index.php?products');
  }
}

function add_category() {
  if (isset($_POST['submit'])) {
    $cat_title = escape_string($_POST['cat_title']);
    $query = query("INSERT INTO categories(cat_title) VALUES ('{$cat_title}');");
  }
}

function get_users_in_dash() {
  $query = query("SELECT * FROM users");
  confirm($query);
  while ($row = fetch_array($query)) {
    $user = <<<DELIMITER
                        <tr>
                                 <td>{$row['user_id']}</td>
                                 <td><img style="width: 150px; height: 150px" class="admin-user-thumbnail user_image" src="../uploads/{$row['user_image']}" alt="Image of {$row['username']}"></td>
                                 <td>{$row['username']}</td>
                                 <td>{$row['first_name']}</td>
                                 <td>{$row['last_name']}</td>
                                 <td>
                                         <a href="index.php?edit_u&id={$row['user_id']}" class="btn btn-warning btn-lg">Edit</a>
                                         <a href="delete_user.php?id={$row['user_id']}" class="btn btn-danger btn-lg">Delete</a>
                                 </td>
                        </tr>
DELIMITER;
    echo $user;
  }
}

function register_user() {
  if (isset($_POST['register'])) {
    $first_name = escape_string($_POST['first_name']);
    $last_name = escape_string($_POST['last_name']);
    $user_image = escape_string($_FILES['file']['name']);
    $image_temp_location = escape_string($_FILES['file']['tmp_name']);
    move_uploaded_file($_FILES['file']['tmp_name'], "../uploads/users/".$user_image);
    $username = escape_string($_POST['username']);
    $password = escape_string($_POST['password']);
    $query = query("INSERT INTO users(username, password, first_name, last_name, user_image) VALUES ('{$username}','{$password}','{$first_name}','{$last_name}','users/{$user_image}')");
    $last_id = last_id();
    set_message($user_image);
  }
}


function get_count($table) {
  $query = query("SELECT * FROM {$table}");
  confirm($query);
  echo mysqli_num_rows($query);
}

function delete_row($table, $col, $page) {
  $id = escape_string($_GET['id']);
  $query = query("DELETE FROM {$table} WHERE {$col}={$id} ");
  confirm($query);
  redirect($page);
}

function get_product($id) {
  $prod_id = escape_string($id);
  $query = query("SELECT * FROM products WHERE product_id={$prod_id}");
  confirm($query);
  return $query;
}

function get_user($id) {
  $prod_id = escape_string($id);
  $query = query("SELECT * FROM users WHERE user_id={$prod_id}");
  confirm($query);
  return $query;
}
?>
