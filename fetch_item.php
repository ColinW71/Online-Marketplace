<?php
//fetch_item.php
/*
*@author Colin W
*@version 4-23-2023
* Final Project for Web Development.
*/

// Include the file that establishes the database connection
include('database_connection.php');

// Query to select all products from the 'tbl_product' table, ordering them by ID in descending order
$query = "SELECT * FROM tbl_product ORDER BY id DESC";
$statement = $connect->prepare($query);

// Execute the prepared statement to fetch the data
if ($statement->execute()) {
    // Fetch all the results as an associative array
    $result = $statement->fetchAll();
    $output = '';

    // Loop through each product in the result set and create the HTML output
    foreach ($result as $row) {
        $output .= '
        <div class="col-md-3" style="margin-top:12px;">  
            <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" align="center">
                <img src="images/'.$row["image"].'" class="img-responsive" /><br />
                <h4 class="text-info">'.$row["name"].'</h4>
                <h4 class="text-danger">$ '.$row["price"].'</h4>
                <input type="text" name="quantity" id="quantity'.$row["id"].'" class="form-control" value="1" />
                <input type="hidden" name="hidden_name" id="name'.$row["id"].'" value="'.$row["name"].'" />
                <input type="hidden" name="hidden_price" id="price'.$row["id"].'" value="'.$row["price"].'" />
                <input type="button" name="add_to_cart" id="'.$row["id"].'" style="margin-top:5px; background-color: skyblue; border-color: skyblue; color: white;" class="btn btn-success form-control add_to_cart" value="Add to Cart">
            </div>
        </div>
        ';
    }

    // Output the generated HTML content
    echo $output;
}
?>
