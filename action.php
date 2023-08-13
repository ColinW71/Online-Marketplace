<?php
//action.php
/*
*@author Colin W
*@version 4-23-2023
* Final Project for Web Development.
*/
session_start();  // Start a session to store data across multiple requests.

if(isset($_POST["action"]))  // Check if the "action" parameter is set in the POST data.
{
	if($_POST["action"] == "add")  // If action is "add", handle adding products to the shopping cart.
	{
		if(isset($_SESSION["shopping_cart"]))  // Check if the shopping cart session variable is already set.
		{
			$is_available = 0;  // Initialize a flag to track product availability.

			// Loop through the items in the shopping cart.
			foreach($_SESSION["shopping_cart"] as $keys => $values)
			{
				// Check if the current product matches the product being added.
				if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])
				{
					$is_available++;  // Increment the availability flag.
					// Increase the quantity of the existing product in the cart.
					$_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
				}
			}

			// If the product is not already in the cart, add it.
			if($is_available == 0)
			{
				$item_array = array(
					'product_id'         => $_POST["product_id"],
					'product_name'       => $_POST["product_name"],
					'product_price'      => $_POST["product_price"],
					'product_quantity'   => $_POST["product_quantity"]
				);
				$_SESSION["shopping_cart"][] = $item_array;  // Add the new product to the shopping cart.
			}
		}
		else  // If the shopping cart session variable is not set, add the product directly.
		{
			$item_array = array(
				'product_id'         => $_POST["product_id"],
				'product_name'       => $_POST["product_name"],
				'product_price'      => $_POST["product_price"],
				'product_quantity'   => $_POST["product_quantity"]
			);
			$_SESSION["shopping_cart"][] = $item_array;  // Add the new product to the shopping cart.
		}
	}

	// Handle removing products from the shopping cart.
	if($_POST["action"] == 'remove')
	{
		// Loop through the items in the shopping cart.
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			// Check if the product matches the one to be removed.
			if($values["product_id"] == $_POST["product_id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);  // Remove the product from the cart.
			}
		}
	}

	// Handle the checkout process.
	if($_POST["action"] == 'checkout')
	{
		unset($_SESSION["shopping_cart"]);  // Clear the shopping cart to simulate checkout.
	}

	// Handle emptying the shopping cart.
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["shopping_cart"]);  // Clear the shopping cart.
	}
}
?>
