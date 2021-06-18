<?php include('partials/menu.php'); ?>

<?php 
		   //check whether the id is set or not
		if(isset($_GET['id']))
		{
			//get the id and all ther details
			//echo "getting the data";
			$id = $_GET['id'];
			
			//create sql query to get all other details
			$sql2 = "SELECT * FROM tbl_food WHERE id=$id";

			//execute the query
			$res2 = mysqli_query($conn, $sql2);

			//get all the data
			$row2 = mysqli_fetch_assoc($res2);

			//get individual data
			$title = $row2['title'];
			$description  =$row2['description'];
			$price = $row2['price'];
			$current_image = $row2['image_name'];
			$current_category = $row2['category_id'];
			$featured = $row2['featured'];
			$active = $row2['active'];
	
		}
		else
		{
			//redirect to manage food 
			header('location:'.SITEURL.'admin/manage-food.php');
		}
?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Food</h1>

		<br><br>


		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">

			<tr>
				<td>Title: </td>
				<td>
					<input type="text" name="title" value="<?php echo $title; ?>">
				</td>
			</tr>

			<tr>
				<td>Description: </td>
				<td>
					<textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
				</td>
			</tr>

			<tr>
				<td>Price: </td>
				<td>
					<input type="number" name="price" value="<?php echo $price; ?>">
				</td>
			</tr>

			<tr>
				<td>Current Image: </td>
				<td>
					<?php
					    if($current_image == "")
					    {
					    	//display the message
					    	echo "<div class = 'error'>Image not available.</div>";
					    } 
					    else
					    {
					    	//display the image
					    	?>
					    	<img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width = "150px">
					    	<?php 
					    }
					?>
				</td>
			</tr>

			<tr>
				<td>Select New Image: </td>
				<td>
					<input type="file" name="image">
				</td>
			</tr>

			<tr>
				<td>Category: </td>
				<td>
					<select name="category">
							<?php							  
							    //1. create sql query to get all active categories from database
							    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

							    //executing the query
							    $res = mysqli_query($conn, $sql);

							    //count rows to check whether we have categories or not
							    $count = mysqli_num_rows($res);

							    //if count is greather than 0, we have categories else we don't have categories
							    if($count>0)
							    {
							    	//we have categories
							    	while($row=mysqli_fetch_assoc($res))
							    	{
							    		//get the details
							    		$category_title = $row['title'];
							    		$category_id = $row['id'];
							    		?>
							    		<option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
							    		<?php

							    	}
							    }
							    else
							    {
							    	//we do not have categories
							    	?>
							    	<option value="0">No Category Found</option>

							    	<?php 
							    }
							 ?>							
					</select>
				</td>
			</tr>

			<tr>
				<td>Featured: </td>
				<td>
					<input <?php if($featured =="Yes"){echo "checked";}?>
					type="radio" name="featured" value="Yes"> Yes

					<input <?php if($featured =="No"){echo "checked";}?> 
					type="radio" name="featured" value="No"> No
				</td>
			</tr>

			<tr>
				<td>Active: </td>
				<td>
					<input <?php if($active =="Yes"){echo "checked";}?> 
					type="radio" name="active" value="Yes"> Yes

					<input <?php if($active =="No"){echo "checked";}?> 
					type="radio" name="active" value="No"> No
				</td>
			</tr>

			<tr>
				<td>
					<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="submit" name="submit" value="Update Food" class="btn-update">
				</td>
			</tr>

		  </table>
		</form>

		<?php 

	        if(isset($_POST['submit']))
	        {
	        	//echo "Clicked";
	        	//1. get all the values from the form

	        	$id = $_POST['id'];
	        	$title = $_POST['title'];
	        	$description = $_POST['description'];
	        	$price = $_POST['price'];
	        	$current_image = $_POST['current_image'];
	        	$category = $_POST['category'];
	        	$featured = $_POST['featured'];
	        	$active = $_POST['active'];

	        	//2. updating new image
	        	//check the image is selected or not
	        	if(isset($_FILES['image']['name']))
	        	{
	        		//upload button clicked
	        		$image_name = $_FILES['image']['name'];

	        		//check whether the image is available or not
	        		if($image_name != "")
	        		{
	        			//image available
	        			//a. upload the new image	        		
		   		        //get the extension of the image(jpg, png, gif, etc)
		   		        $ext = end(explode('.', $image_name)); 

		   		        //Rename the image
		   		        $image_name = "Food-Name-".rand(000, 999).'.'.$ext;

		   		        //get the source path and destination path
		   		        $src_path = $_FILES['image']['tmp_name'];
		   		        $dest_path = "../images/food/".$image_name;

		   		        //finally upload the image
		   		        $upload = move_uploaded_file($src_path, $dest_path);

		   		        //check whether the image is uploaded or not
		   		        if($upload==false)
		   		        {
		   			        //set message 
		   			        $_SESSION['upload'] = "<div class = 'error'>Failed to upload image</div>";
		   			        //redirect to food page
		   			        header('location:'.SITEURL.'admin/manage-food.php');
		   			        //stop the process
		   			        die();
		   		        }

	        			//b. remove the current image if available
	        			if($current_image!="")
	        			{
	        				//remove the current image
	        				$remove_path = "../images/food".$current_image;

	        				$remove = unlink($remove_path);

	        				//check whether the image if removed or not
	        				if($remove==false)
	        				{
	        					//failed to remove the current image
	        					$_SESSION['remove-failed'] = "<div class = 'error'>Failed to remove current image.</div>";
	        					//redirect to manage food
	        					header('location:'.SITEURL.'admin/manage-food.php');
	        					//stop the process
	        					die();
	        				}
	        			}	
	        		}
	        		else
	        		{
	        			//default image when image is not selected
	        			$image_name = $current_image;
	        		}
	        	}
	        	else
	        	{
	        		//default image when button clicked 
	        		$image_name = $current_image;
	        	}

	        	//3. updating database
	        	$sql3 = "UPDATE tbl_food SET 
	        	    title = '$title',
	        	    description = '$description',
	        	    price = '$price',
	        	    image_name = '$image_name',
	        	    category_id = '$category',
	        	    featured = '$featured',
	        	    active = '$active'
	        	    WHERE id=$id
	        	";

	        	//execute the query
	        	$res3 = mysqli_query($conn, $sql3);

	        	//4. redirecting to manage food with message
	        	//check whether executed or not
	        	if($res3==true)
	        	{
	        		//food updated 
	        		$_SESSION['update'] = "<div class = 'success'>Food item Updated Successfully!.</div>";
	        		header('location:'.SITEURL.'admin/manage-food.php');
	        	}
	        	else
	        	{
	        		//failed to update the food
	        		$_SESSION['update'] = "<div class = 'error'>Failed to update Food item.</div>";
	        		header('location:'.SITEURL.'admin/manage-food.php');
	        	}
	        }
	       
		?>

	</div>
</div>

<?php include('partials/footer.php'); ?>