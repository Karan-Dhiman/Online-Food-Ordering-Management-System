<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Admin</h1>

		<br /><br />

		<?php
		     if(isset($_SESSION['add']))
		     {
		     	echo $_SESSION['add']; //display successful message
		     	unset($_SESSION['add']); //remove successful message
		     }
		?>

		<form action="" method="POST">

			<table class="tbl-admin">
				<tr>
					<td>Full Name:</td>
					<td>
						<input type="text" name="full_name" placeholder="Enter your name" class="input-box">
					</td>
				</tr>

				<tr>
					<td>Username: </td>
					<td>
						<input type="text" name="username" placeholder="Enter the username" class="input-box">
					</td>
				</tr>

					<td>Password: </td>
					<td>
						<input type="Password" name="password" placeholder="Enter your password" class="input-box">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-update">		
					</td>
				</tr>
			</table>
		</form>

	</div>
</div>


<?php include('partials/footer.php'); ?>

<?php
    //process the value from the form and save it in database
    //Check whether the submit button is clicked or not.
    if(isset($_POST['submit']))
    {
    	//button clicked
    	//echo"Button Clicked";

    	//Get the data from the form
    	$full_name = $_POST['full_name'];
    	$username = $_POST['username'];
    	$password = md5($_POST['password']); //Password encrypted with md5

    	//SQL query to save the data into the database.
    	$sql = "INSERT INTO tbl_admin SET
    	    full_name = '$full_name',
    	    username  = '$username',
    	    password = '$password'
    	";


    	//executing query and saving data into database
    	$res = mysqli_query($conn, $sql) or die(mysqli_error());

    	//check whether the data is inserted or not.
    	if($res==TRUE)
    	{
    		//echo"Data inserted";
    		//create a session variable to display a message
    		$_SESSION['add'] = "<div class = 'success'>Admin Added Succesfully</div>";
    		//redirect page to manage admin page
    		header("location:".SITEURL.'admin/manage-admin.php');

    	}
    	else
    	{
    		//echo "failed to insert data";
    		$_SESSION['add'] = "<div class='error'>Failed to add Admin</div>";
    		//redirect page to add admin page
    		header("location:".SITEURL.'admin/add-admin.php');
    	}

    }
?>
