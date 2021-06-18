<?php include('partials/menu.php'); ?>

<div class="main-content">
		<div class="wrapper">
			<h1>Change Admin Password</h1>
			<br /><br />

			<?php
			    if(isset($_GET['id']))
			    {
			    	$id = $_GET['id'];
			    }

			?>

			<form action="" method="POST" >
				<table class="tbl-30">
					<tr>
						<td>Old Password: </td>
						<td>
							<input type="password" name="current_password" placeholder="Current Password">
						</td>
					</tr>
					
					<tr>
						<td>New Password: </td>
						<td>
							<input type="password" name="new_password" placeholder="New Password">
						</td>
					</tr>

					<tr>
						<td>Confirm Password:</td>
						<td>
							<input type="password" name="confirm_password" placeholder="Confirm Password">
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="submit" name="submit" value="Change Password" class="btn-update">
						</td>
					</tr>
				</table>
				
			</form>
		</div>
</div>
<?php 
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
    	//echo "clicked";
    	//get the data from the form
    	$id = $_POST['id'];
    	$current_password = md5($_POST['current_password']);
    	$new_password = md5($_POST['new_password']);
    	$confirm_password = md5($_POST['confirm_password']);

    	//check whether the user with current id and passsword exists
    	$sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    	//check whether the new password and confimr the password matched or not 
    	$res = mysqli_query($conn, $sql);

    	if($res==TRUE)
    	{
    		//check whether the data is available or not
    		$count = mysqli_num_rows($res);

    		if($count==1)
    		{
    			//user exists and password can be changed
    			//echo "User Found";
    			//check whether the new password and confirmed password match or not
    			if($new_password==$confirm_password)
    			{
    				//update the password
    				//echo "password match";
    				$sql2 = "UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id='$id'  
    				";
    				//execute the query
    				$res2 = mysqli_query($conn, $sql2);

    				//check whether the query is executed or not
    				if($res2==true)
    				{
    					//display success message 
    					$_SESSION['change-pwd'] = "<div class= 'success'>Passowrd Changed  Successfully.</div>";
    			        //redirect the user
    			        header("location:".SITEURL.'admin/manage-admin.php');
    				}
    				else
    				{
    					//display error message
    					$_SESSION['change-pwd'] = "<div class= 'error'>Failed to change the password.</div>";
    			        //redirect the user
    			        header("location:".SITEURL.'admin/manage-admin.php');
    				}
    			}
    			else
    			{
    				//redirect the user
    				$_SESSION['pwd-not-match'] = "<div class= 'error'>Passowrd did not match.</div>";
    			//redirect the user
    			header("location:".SITEURL.'admin/manage-admin.php');
    			}

    		}
    		else
    		{
    			//user doesn't exist set message and redirect.
    			$_SESSION['user-not-found'] = "<div class= 'error'>User Not Found.</div>";
    			//redirect the user
    			header("location:".SITEURL.'admin/manage-admin.php');
         	}

        }
    	//change password if all the above conditions are true.
    }
?>


<?php include('partials/footer.php'); ?>