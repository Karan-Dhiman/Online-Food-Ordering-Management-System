<?php 
    //include constants.php for URL
    include('../config/constants.php');

    //to delete all the sessions
    session_destroy();

    //redirect to login page
    header('location:'.SITEURL.'admin/login.php');
?>