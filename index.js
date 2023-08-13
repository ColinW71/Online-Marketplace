/*
* index.js
*@author Colin W
*@version 4-23-2023
* Final Project for Web Development.
*/
$(document).ready(function(){

    // Function to load product items from the server and display them in the 'display_item' div
    function load_product()
    {
        $.ajax({
            url:"fetch_item.php",
            method:"POST",
            success:function(data)
            {
                $('#display_item').html(data);
            }
        });
    }

    // Function to load cart data from the server and update cart details and total price
    function load_cart_data()
    {
        $.ajax({
            url:"fetch_cart.php",
            method:"POST",
            dataType:"json",
            success:function(data)
            {
                $('#cart_details').html(data.cart_details);
                $('.total_price').text(data.total_price);
                $('.badge').text(data.total_item);
            }
        });
    }

    // Load product items on page load
    load_product();

    // Load cart data on page load
    load_cart_data();
    
    // Enable the Bootstrap popover for the shopping cart icon
    $('#cart-popover').popover({
        html : true,
        container: 'body',
        content:function(){
            // Return the content from the hidden popover wrapper
            return $('#popover_content_wrapper').html();
        }
    });

    // When the "Add to Cart" button is clicked on a product item
    $(document).on('click', '.add_to_cart', function(){
        var product_id = $(this).attr("id");
        var product_name = $('#name'+product_id+'').val();
        var product_price = $('#price'+product_id+'').val();
        var product_quantity = $('#quantity'+product_id).val();
        var action = "add";
        
        // Check if the product quantity is greater than 0
        if(product_quantity > 0)
        {
            // Make an AJAX request to add the product to the cart
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{product_id:product_id, product_name:product_name, product_price:product_price, product_quantity:product_quantity, action:action},
                success:function(data)
                {
                    // Reload cart data and show a success alert
                    load_cart_data();
                    alert("Item has been Added into Cart");
                }
            });
        }
        else
        {
            alert("Please Enter Number of Quantity");
        }
    });

    // When the "Delete" button is clicked on a product item in the cart
    $(document).on('click', '.delete', function(){
        var product_id = $(this).attr("id");
        var action = 'remove';
        // Ask for confirmation before removing the product from the cart
        if(confirm("Are you sure you want to remove this product?"))
        {
            // Make an AJAX request to remove the product from the cart
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{product_id:product_id, action:action},
                success:function()
                {
                    // Reload cart data, hide the popover, and show a success alert
                    load_cart_data();
                    $('#cart-popover').popover('hide');
                    alert("Item has been removed from Cart");
                }
            })
        }
        else
        {
            return false;
        }
    });

    // When the "Check out" button is clicked in the cart popover
    $(document).on('click', '#check_out_cart', function(){
        var action = 'checkout';
        // Make an AJAX request to perform the checkout action
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action},
            success:function()
            {
                // Reload cart data, hide the popover, and show a success alert
                load_cart_data();
                $('#cart-popover').popover('hide');
                alert("Your Cart has been checked out.");
            }
        });
    });

    // When the "Clear" button is clicked in the cart popover
    $(document).on('click', '#clear_cart', function(){
        var action = 'empty';
        // Make an AJAX request to clear the cart
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action},
            success:function()
            {
                // Reload cart data, hide the popover, and show a success alert
                load_cart_data();
                $('#cart-popover').popover('hide');
                alert("Your Cart has been cleared");
            }
        });
    });
});
