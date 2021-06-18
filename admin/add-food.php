<?php include('partials/menu.php'); ?>
<div class="main-content">
	<div class="wrapper">
		<h1>Add Food</h1>

		<br><br>

		<?php
		    if(isset($_SESSION['upload']))
		    {
		    	echo $_SESSION['upload'];
		    	unset($_SESSION['upload']);
		    }
		?>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="Title of the Food">
					</td>
				</tr>

				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
					</td>
				</tr> 

				<tr>
					<td>Price: </td>
					<td>
						<input type="number" name="price">
					</td>
				</tr>

				<tr>
					<td>Select Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Category: </td>
					<td>
						<select name="category">

							<?php
							    //create php code to display categories from database 
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
							    		$id = $row['id'];
							    		$title = $row['title'];
							    		?>
							    		<option value="<?php echo $id; ?>"><?php echo $title; ?> 
							    	     </option>

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


							    //2. display an dropdown
							 ?>							
						</select>
						
					</td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input type="radio" name="featured" value="Yes"> Yes
						<input type="radio" name="featured" value="No"> No
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
					    <input type="radio" name="active" value="Yes"> Yes
					    <input type="radio" name="active" value="No"> No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Food" class="btn-update">
					</td>
				</tr>
			
		</table>
			
	</form>


	<?php
	    //check whether the button is clicked or not
	    if(isset($_POST['submit']))
	    {
	    	//add the food in database
	    	//echo "clicked";


	    	//1. Get the data from the form
	    	$title = $_POST['title'];
	    	$description = $_POST['description'];
	    	$price = $_POST['price'];
	    	$category = $_POST['category'];

	    	//check whether the radio button for featured and active are checked or not
	    	if(isset($_POST['featured']))
	    	{
	    		$featured = $_POST['featured'];
	    	}
	    	else
	    	{
	    		$featured = "No"; //setting the default value
	    	}
	    	if(isset($_POST['active']))
	    	{
	    		$active = $_POST['active'];
	    	}
	    	else
	    	{
	    		$active = "No"; //setting the default value
	    	}

	    	//2. upload the image if selected
	    	//check whether the selected image is clicked or not and upload the image only if the image is clicked
	    	if(isset($_FILES['image']['name']))
	    	{
	    		//get the details of the selected image
	    		$image_name = $_FILES['image']['name'];

	    		//check whether the image is selected or not and upload image if selected
	    		if($image_name != "")
	    		{
	    			//image is selected

	    			//a. rename the image
	    			//get the extension of the selected image (jpg, jpeg, png, gif, etc)
	    			$ext = end(explode('.', $image_name));
	    			
	    			//create new name for the image 
	    			$image_name = "Food-Name-".rand(0000,9999).".".$ext;

	    			//b. upload the image
	    			//get the source path and destination path
	    			//source path is the currect location of the image
	    			$src = $_FILES['image']['tmp_name'];

	    			//destination path for the image to be uploaded
	    			$dst = "../images/food/".$image_name;

	    			//finally upload the image 
	    			$upload = move_uploaded_file($src, $dst);


	    			//check whether the image is uploaded or not
	    			if(upload==false)
	    			{
	    				//failed to upload the image
	    				$_SESSION['upload'] = "<div class = 'error'>Failed to upload the image.</div>";
	    				//redirect to food page
	        		    header('location:'.SITEURL.'admin/add-food.php');
	        			die();// stop the process    				
	    			}

	    		}
	    	}
	    	else
	    	{
	    		//set deafult value for our image
	    		$image_name = "";

	    	}



	    	//3. insert into the database
	    	//create a sql query to set or add food 
	    	//for  numerical value, we don not need to pass value inside quotes '' but for the string values it is necessary

	    	$sql2 = "INSERT INTO tbl_food SET 
	    	title = '$title',
	    	description = '$description',
	    	price = '$price',
	    	image_name = '$image_name',
	    	category_id = '$category',
	    	featured = '$featured',
	    	active = '$active'
	    	";


	    	//execute the query
	    	$res2 = mysqli_query($conn, $sql2);
	    	//check whether data is inserted or not

	    	if($res2 == true)
	    	{
	    		//data inseted successfully
	    		$_SESSION['add'] = "<div class = 'success'>Food Added Successfully!.</div>";
	    		header('location:'.SITEURL.'admin/manage-food.php');
	    	}
	    	else
	    	{
	    		//failed to insert the data
	    		$_SESSION['add'] = "<div class = 'error'>Failed to add Food.</div>";
	    		header('location:'.SITEURL.'admin/manage-food.php');
	    	}



	    	//4. redirect to manage food and message




	    } 
	?>
		
	</div>
</div>

<?php include('partials/footer.php'); ?>