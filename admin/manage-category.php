<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
    	<h1>Manage Category</h1>

    	<br /><br />

    	<?php
		    if(isset($_SESSION['add']))
		    {
		    	echo $_SESSION['add'];
		    	unset($_SESSION['add']);
		    }
		?>

		<?php
		    if(isset($_SESSION['remove']))
		    {
		    	echo $_SESSION['remove'];
		    	unset($_SESSION['remove']);
		    }
		?>

		<?php
		    if(isset($_SESSION['delete']))
		    {
		    	echo $_SESSION['delete'];
		    	unset($_SESSION['delete']);
		    }
		?>

		<?php
		    if(isset($_SESSION['no-category-found']))
		    {
		        echo $_SESSION['no-category-found'];
		    	unset($_SESSION['no-category-found']);
		    }
		?>

		<?php
		    if(isset($_SESSION['update']))
		    {
		        echo $_SESSION['update'];
		    	unset($_SESSION['update']);
		    }
		?>

		<?php
		    if(isset($_SESSION['upload']))
		    {
		        echo $_SESSION['upload'];
		    	unset($_SESSION['upload']);
		    }
		?>

		<?php
		    if(isset($_SESSION['failed-remove']))
		    {
		        echo $_SESSION['failed-remove'];
		    	unset($_SESSION['failed-remove']);
		    }
		?>

		<br><br>

			<!-- button to add admin -->
			<a href="<?php echo SITEURL; ?>Admin/add-category.php" class="btn-add">Add Catagory</a>
			<br /> <br /> 

			<table class="tbl-full"> 
				<tr>
					<th>S.No</th>
					<th>Title</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>

				<?php
				   //query to get all category from database
				   $sql = "SELECT * FROM tbl_category";

				   //exeecute query
				   $res = mysqli_query($conn, $sql);

				   //count rows
				   $count = mysqli_num_rows($res);

				   //create serial number variable
				   $sn = 1;

				   //check whether we have database or not
				   if($count>0)
				   {
				   	//we have data in the database
				   	//get the data and display
				   	while($row=mysqli_fetch_assoc($res))
				   	{
				   		$id = $row['id'];
				   		$title = $row['title'];
				   		$image_name = $row['image_name'];
				   		$featured = $row['featured'];
				   		$active = $row['active'];

				   		?>


				   		<tr>
					            <td><?php echo $sn++; ?> </td>
					            <td><?php echo $title; ?></td>


					            <td>
					            	<?php
					            	//check whether image name is available or not
					            	if($image_name!='')
					            	{
					            		//display image name 
					            		?>
					            		<img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
					            		
					            		<?php
					            	
					            	}
					            	else
					            	{
					            		//display the message
					            		echo "<div class='error'>No image added.</div>";
					            	}	
					                ?>	
					            		
					            </td>
					            

					            <td><?php echo $featured; ?></td>
					            <td><?php echo $active; ?></td>
					            <td>
						            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-update">Update Category</a> 
						            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-delete">Delete Category</a>
					            </td>
				        </tr>
            
				   		<?php


				   	}
				   }
				   else
				   {
				   	//we do not have the data in the database
				   	?>
				   	<tr>
				   		<td colspan="6"><div class="error">No Category Added.</div></td>
				   	</tr>

				   	<?php 


				   }
				?>

				

			</table>
    </div>
</div>

<?php include('partials/footer.php'); ?>