<?php
//fetch_cart.php
/*
*@author Colin W
*@version 4-23-2023
* Final Project for Web Development.
*/
// Start the PHP session
session_start();

// Initialize variables to hold the total price and total item count
$total_price = 0;
$total_item = 0;

// Initialize the HTML output for the table
$output = '
<div class="table-responsive" id="order_table">
    <table class="table table-bordered table-striped">
        <tr>  
            <th width="40%">Product Name</th>  
            <th width="10%">Quantity</th>  
            <th width="20%">Price</th>  
            <th width="15%">Total</th>  
            <th width="5%">Action</th>  
        </tr>
';

// Check if the shopping cart in the session is not empty
if (!empty($_SESSION["shopping_cart"])) {
    // Loop through each item in the shopping cart
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        // Add a row for each item in the output table
        $output .= '
        <tr>
            <td>'.$values["product_name"].'</td>
            <td>'.$values["product_quantity"].'</td>
            <td align="right">$ '.$values["product_price"].'</td>
            <td align="right">$ '.number_format($values["product_quantity"] * $values["product_price"], 2).'</td>
            <td><button name="delete" class="btn btn-danger btn-xs delete" id="'. $values["product_id"].'">Remove</button></td>
        </tr>
        ';

        // Calculate the total price and total item count for the entire cart
        $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
        $total_item = $total_item + 1;
    }

    // Add a row at the end to display the total price for all items in the cart
    $output .= '
    <tr>  
        <td colspan="3" align="right">Total</td>  
        <td align="right">$ '.number_format($total_price, 2).'</td>  
        <td></td>  
    </tr>
    ';
} else {
    // If the cart is empty, show a message indicating it
    $output .= '
    <tr>
        <td colspan="5" align="center">
            Your Cart is Empty!
        </td>
    </tr>
    ';
}

// Close the table and div tags for the HTML output
$output .= '</table></div>';

// Prepare an array containing cart details, total price, and total item count
$data = array(
    'cart_details'  =>  $output,
    'total_price'   =>  '$' . number_format($total_price, 2),
    'total_item'    =>  $total_item
);  

// Encode the array as a JSON object and output it
echo json_encode($data);
?>
