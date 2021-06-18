<?php 

    //authorisation and access control
    //check whether the user is logged in or not
    if(!isset($_SESSION['user'])) //if user is not set
    {
    	//user is not logged in
    	//redirect to login page with message

    	$_SESSION['no-login-message'] = "<div class = 'error'>Please Login to access admin panel.</div>";
    	//redirect to login page
    	header('location:'.SITEURL.'admin/login.php');
    }

?>