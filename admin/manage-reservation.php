<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
    	<h1>Manage Reservation</h1>
    	<br /> <br/> <br />

    	<?php
		    if(isset($_SESSION['update']))
		    {
		    	echo $_SESSION['update'];
		    	unset($_SESSION['update']);
		    }
		?>

		<?php
		    if(isset($_SESSION['delete']))
		    {
		    	echo $_SESSION['delete'];
		    	unset($_SESSION['delete']);
		    }
		?>
		<br><br>

			<table class="tbl-full"> 
				<tr>
					<th>S.No</th>
					<th>Customer Name</th>
					<th>Customer Email</th>
					<th>Customer Contact</th>
					<th>Restuarant</th>
					<th>Date</th>
					<th>Tables</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>

				<?php
				    //get all the orders from database
				    $sql = "SELECT * FROM tbl_reservation ORDER BY id DESC";
				    //execute the query
				    $res = mysqli_query($conn, $sql);
				    //count the rows
				    $count = mysqli_num_rows($res);

				    $sn=1;

				    if($count>0)
				    {
				    	//order available
				    	while($row=mysqli_fetch_assoc($res))
				    	{
				    		//get all the orders
				    		$id=$row['id'];
				    		$customer_name=$row['customer_name'];
				    		$customer_email=$row['customer_email'];
				    		$customer_contact=$row['customer_contact'];
				    		$restaurant=$row['restaurant'];
				    		$date=$row['date'];
				    		$tables=$row['tables'];
				    		$status=$row['status'];
				    		
				    		?>
				    		<tr>
					            <td><?php echo $sn++; ?></td>
					            <td><?php echo $customer_name; ?></td>
					            <td><?php echo $customer_email; ?></td>
					            <td><?php echo $customer_contact; ?></td>
					            <td><?php echo $restaurant; ?></td>
					            <td><?php echo $date; ?></td>
					            <td><?php echo $tables; ?></td>

					            <td>
					            	<?php 
					            	    if($status=="Reserved")
					            	    {
					            	    	echo "<label style='color: green'>$status</label>";
					            	    } 
					            	    elseif($status=="Pending")
					            	    {
					            	    	echo "<label style='color: orange'>$status</label>";
					            	    }
					            	    elseif($status=="Cancelled")
					            	    {
					            	    	echo "<label style='color: red'>$status</label>";
					            	    }
					            	?>
					            </td>
					            <td>
					            	<a href="<?php echo SITEURL; ?>admin/delete-reservation.php?id=<?php echo $id; ?>" class="btn-delete">Delete Reservation</a> 
					            </td>
				            </tr>            

				    		<?php

				    	}
				    }
				    else
				    {
				    	//order not available
				    	echo "<tr><td class = 'error' colspan=''>NO reservations made.</td></tr>";
				    }
				?>

			</table>
    </div>
</div>

<?php include('partials/footer.php'); ?>