<?php 
     
    //include constants.php file here
    include('../config/constants.php');

    //get the id of the order that is to be deleted
    echo $id = $_GET['id'];


    
    //then create sql query to delete the order 
    $sql = "DELETE FROM tbl_order WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);
    
    //check whether th equery executed successfully or  not
    if($res == TRUE)
    {
    	//then query executed successfuly & order deleted
    	//echo "order deleted";
    	//create session variable to display message
    	$_SESSION['delete'] = "<div class='success'>Order Deleted Successfully.</div>";
    	//Redirect to manage order page
    	header('location:'.SITEURL.'admin/manage-order.php');
    }
    else
    {
    	//Failed to delete order
    	//echo "Failed to delete order";
    	//create session variale to show failed message

    	$_SESSION['delete'] = "<div class='error'>Failed to delete the order, try again later.</div>";
    	header('location:'.SITEURL.'admin/manage-order.php');
    }

    //redirect to manage order page(success/error)
    

?>