<?php include('partials/menu.php'); ?>

	<!--Main Content Section Starts-->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Admin</h1>
			<br /><br />

			<?php 
			     if(isset($_SESSION['add']))
			     {
			     	echo$_SESSION['add']; //adding successful message
			     	unset($_SESSION['add']); //removing successful message
			     } 
			     if(isset($_SESSION['delete']))
			     {
			     	echo $_SESSION['delete'];
			     	unset($_SESSION['delete']);
			     }

			     if(isset($_SESSION['update']))
			     {
			     	echo $_SESSION['update'];
			     	unset($_SESSION['update']);
			     }

			     if(isset($_SESSION['user-not-found']))
			     {
			     	echo $_SESSION['user-not-found'];
			     	unset($_SESSION['user-not-found']);
			     }

			     if(isset($_SESSION['pwd-not-match']))
			     {
			     	echo $_SESSION['pwd-not-match'];
			     	unset($_SESSION['pwd-not-match']);
			     }

			     if(isset($_SESSION['change-pwd']))
			     {
			     	echo $_SESSION['change-pwd'];
			     	unset($_SESSION['change-pwd']);
			     }
			?>

			<br /><br />

			<!-- button to add admin -->
			<a href="add-admin.php" class="btn-add">Add Admin</a>
			<br /> <br /> 

			<table class="tbl-full"> 
				<tr>
					<th>S.No</th>
					<th>Full Name</th>
					<th>Username</th>
					<th>Actions</th>
				</tr>

				<?php
				    //query to get all the admin
				    $sql = "SELECT * FROM tbl_admin";
				    //execute the query
				    $res = mysqli_query($conn, $sql);

				    //check whether the query is exeuted or not
				    if($res==TRUE)
				    {
				    	//count rows  to check whether we have data in database or not
				    	$count = mysqli_num_rows($res); //function to get all the rows in database

				    	$sn=1; //create a variable and assign the value

				    	//check the number of rows
				    	if($count>0)
				    	{
				    		//we have data in database
				    		while($rows=mysqli_fetch_assoc($res))
				    		{
				    			//using while loop to get all the data from the database 
				    			//and while loop will run as long as we have the data in database

				    			//get individual data
				    			$id=$rows['id'];
				    			$full_name=$rows['full_name'];
				    			$username=$rows['username'];

				    			//display the values in our table
				    			?>

				    			<tr>
					                <td><?php echo $sn++; ?></td>
					                <td><?php echo $full_name;?></td>
					                <td><?php echo $username; ?></td>
					                <td>
					                	<a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-add">Change Pasword</a>
						                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-update">Update Admin</a> 
						                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-delete">Delete Admin</a>
					                </td>
				                </tr>
				    		
				    			<?php
				    			
				    		}
				    	}
				    	else
				    	{
				    		//we do not have the data in databse
				    	}

				    }
				?>

			</table>
		</div>	
	</div>
	<!--Main Content Ends-->

<?php include('partials/footer.php'); ?>