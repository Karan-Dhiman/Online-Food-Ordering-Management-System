<?php 
     
    //include constants.php file here
    include('../config/constants.php');

    //get the id of the admin that is to be deleted
    echo $id = $_GET['id'];


    
    //then create sql query to delete the admin 
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);
    
    //check whether th equery executed successfully or  not
    if($res == TRUE)
    {
    	//then query executed successfuly & admin deleted
    	//echo "Admin deleted";
    	//create session variable to display message
    	$_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
    	//Redirect to manage admin page
    	header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
    	//Failed to delete admin
    	//echo "Failed to delete admin";
    	//create session variale to show failed message

    	$_SESSION['delete'] = "<div class='error'>Failed to delete the admin, try again later.</div>";
    	header('location:'.SITEURL.'admin/manage-admin.php');
    }


    //redirect to manage admin page(success/error)
    

?>