<?php

	
	include("../connection/connect.php"); 


    /* The search input from user ** passed from jQuery .get() method */
    $param = $_GET["product-search"];


    /* If connection to database, run sql statement. */
    if ($con) {

        /* Fetch the users input from the database and put it into a
         valuable $fetch for output to our table. */
        $fetch = mysql_query("SELECT product.product_id, product.product_number, product_name, vendor.vend_name, product.base_price, product.sizes FROM product, vendor WHERE product.fkvendor_id=vendor.vendor_id AND product_number REGEXP '^$param'");
		
        /*
           Retrieve results of the query to and build the table.
           We are looping through the $fetch array and populating
           the table rows based on the users input.
         */
		 

        while ( $row = mysql_fetch_object( $fetch ) ) {
			echo '<tr>';
			echo '<td>' . $row->product_number . '</td>';
			echo '<td>' . $row->product_name . '</td>';
			echo '<td>' . $row->vend_name . '</td>';
			echo '<td>' . $row->base_price . '</td>';
			echo '<td>' . $row->sizes . '</td>';
		    echo '<td><a href="editProduct.php?product_id=' . $row->product_id . '"><img src="images/icn_edit.png"></a></td>';
            echo "</tr>"; 
       
        }

    }

    /* Free connection resources. */
    mysql_close($con);

    /* Toss back the results to populate the table. */
    //echo $sResults;

?>