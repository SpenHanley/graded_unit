<?php
require_once('config.php');
if (isset($_GET['add'])) {
	/*
	$_SESSION['product_' . $_GET['add']] += 1;
	redirect('index.php');
	*/
	$query = query("SELECT * FROM products WHERE product_id=".escape_string($_GET['add'].""));
	confirm($query);
	
	while ($row = fetch_array($query)) {
		if ($row['product_quantity'] != $_SESSION['product_'.$_GET['add']]) 
		{
			$_SESSION['product_' . $_GET['add']] += 1;
			redirect("checkout.php");
		} else {
			set_message("We only have {$row['product_quantity']} {$row['product_title']} available.");
			redirect("checkout.php");
		}
	}
}

if (isset($_GET['remove'])) {
	$rem = $_SESSION['product_' . $_GET['remove']]--;
	if ($_SESSION['product_' . $_GET['remove']] < 1) {
		if (isset($_SESSION['item_quantity'])-1  < 1) {
			unset($_SESSION['item_quantity']);
		}
		unset($_SESSION['product_' . $_GET['remove']]);
		redirect("checkout.php");
	} else {
		redirect("checkout.php");
	}
}

if (isset($_GET['delete'])) {
	if (isset($_SESSION['product_'.$_GET['delete']])) {
		if (isset($_SESSION['item_quantity'])-1 < 1) {
			unset($_SESSION['item_quantity']);
		}
		unset($_SESSION['product_'.$_GET['delete']]);
		redirect("checkout.php");
	} else {
		redirect("checkout.php");
	}
}

function cart() {
	$total = 0;
	$item_quantity = 0;
	
	// PayPal reserved terms
	$item_name = 1;
	$item_number  = 1;
	$amount = 1;
	$quantity = 1;
	
	foreach ($_SESSION as $name => $value) {
		if (substr($name, 0, 8) == "product_") {
			$length = strlen($name-8);
			$id = substr($name, 8, $length);
			$query = query("SELECT * FROM products WHERE product_id=".escape_string($id)."");
			confirm($query);
			while ($row = fetch_array($query)) {
				$sub = $row['product_price'] * $value;
				$item_quantity += $value;
				$_SESSION['item_quantity'] = $item_quantity;
				$product = <<<DELIMITER
				<tr>
					<td>{$row['product_title']}</td>
					<td>{$row['product_price']}</td>
					<td>{$value}</td>
					<td>{$sub}</td>
					<td>
					<a class='btn btn-success' href='cart.php?add={$row['product_id']}'><span class='glyphicon glyphicon-plus'></span></a>
					<a class='btn btn-warning' href='cart.php?remove={$row['product_id']}'><span class='glyphicon glyphicon-minus'></span></a>
					<a class='btn btn-danger' href='cart.php?delete={$row['product_id']}'><span class='glyphicon glyphicon-remove'></span></a>
					</td>
				</tr>
				<input type='hidden' name='item_name_{$item_name}' value='{$row['product_title']}' />
				<input type='hidden' name='item_number_{$item_number}' value='{$row['product_id']}' />
				<input type='hidden' name='amount_{$amount}' value='{$row['product_price']}' />
				<input type='hidden' name='quantity_{$quantity}' value='{$value}' />
DELIMITER;
				
				$_SESSION['total_price'] = $total += $sub;
				echo $product;
				$item_name++;
				$item_number++;
				$amount++;
				$quantity++;
			}
		}
	}
}

function show_paypal() {
	 if (isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {
		 $paypal_button = <<<DELIMITER
		 <input type='image' name='upload' border='0' src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif' alt='PayPal - The safer, easier way to pay online' />
DELIMITER;
		return $paypal_button;
	 }
}

function report() {
	if (isset($_GET['tx'])) {
		$amount = $_GET['amt'];
		$currency = $_GET['cc'];
		$transaction = $_GET['tx'];
		$status = $_GET['st'];
		
		$send_order = query("INSERT INTO orders(order_amount, order_currency, order_transaction, order_status) VALUES ('{$amount}', '{$currency}', '{$transaction}', '{$status}')");
		$last_id = last_id();
		echo $last_id;
		confirm($send_order);
		$total = 0;
		$item_quantity = 0;
		$item_title = "";
		foreach ($_SESSION as $name => $value) {
			if ($value > 0) {
				if (substr($name, 0, 8) == "product_") {
					$length = strlen($name-8);
					$id = substr($name, 8, $length);
					$query = query("SELECT * FROM products WHERE product_id =".escape_string($id)."");
					confirm($query);
					while($row = fetch_array($query)) {
						$product_price = $row['product_price'];
						$product_title = $row['product_title'];
						$sub = $row['product_price'] * $value;
						$item_quantity += $value;
						$insert_report = query("INSERT INTO reports(product_id, order_id, product_price, product_quantity, product_title) VALUES ('{$id}', '{$last_id}','{$product_price}','{$value}', '{$product_title}')");
						confirm($insert_report);
					}
					$total += $sub;
					//$item_quantity;
					session_destroy();
				}
			}
		}
	} else {
		redirect('index.php');
	}
}
?>
