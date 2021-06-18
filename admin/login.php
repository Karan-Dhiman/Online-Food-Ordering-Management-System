<?php include('../config/constants.php'); ?>

<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="../css/admin.css">
</head>

<body>
	<div class="login">
		<h1 class="text-center">Admin Login</h1>
		<br><br>

		<?php 
		    if(isset($_SESSION['login']))
		    {
		    	echo $_SESSION['login'];
		    	unset($_SESSION['login']);
		    }
		    if(isset($_SESSION['no-login-message']))
		    {
		    	echo $_SESSION['no-login-message'];
		    	unset($_SESSION['no-login-message']);
		    }
		?>
		<br><br>
		<!-- Login Form -->
		<form action="" method="POST" class="text-center">
			Username: <br>
			<input type="text" name="username" placeholder="Enter Username"><br><br>
			Password: <br>
			<input type="password" name="password" placeholder="Enter Password">
            <br><br>
			<input type="submit" name="submit" value="Log In" class="btn-primary">
            <br><br>
		</form>

	</div>

</body>
</html>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
    	//process for login
    	//get the username
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //SQL to check whether the user with username and passwordexists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
        	//user not available
        	$_SESSION['login'] = "<div class = 'success'> Login Successful.</div>";
        	$_SESSION['user'] = $username;


        	//redirect to homepage
        	header('location:'.SITEURL.'admin/');
        }
        else
        {
        	//user not available and login fail
        	$_SESSION['login'] = "<div class = 'error text-center'>Login Failed.</div>";
        	//redirect to homepage
        	header('location:'.SITEURL.'admin/login.php');

        }

    }
?>