<?php include('partials-front/menu.php'); ?>

<?php
    //check whether reservation id is set or not
    if(isset($_GET['id']))
    {
        //get the reservation id & the details of the selected food
        $id = $_GET['id'];

        //get the details of the reervation
        $sql = "SELECT * FROM tbl_reservation WHERE id=$id";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //count the rows
        $count = mysqli_num_rows($res);
    }
?>

<!-- reservation form Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your Reservation.</h2>

            <form action="" method="POST" class="order">
                
                <fieldset>
                    <legend class="text-white text-center"><b>Reservation Details</b></legend>
                    <div class="order-label text-white">Full Name: </div>
                    <input type="text" name="customer_name" placeholder="Enter Your Name" class="input-responsive" required>

                    <div class="order-label text-white">Email: </div>
                    <input type="email" name="customer_email" placeholder="Enter Your Email ID" class="input-responsive" required>

                    <div class="order-label text-white">Phone Number: </div>
                    <input type="tel" name="customer_contact" placeholder="Enter your contact number" class="input-responsive" required>

                    <div class="order-label text-white">Restaurant: </div>
                    <input type="text" name="restaurant" placeholder="Enter Your Name of the Restaurant" class="input-responsive" required>

                    <div class="order-label text-white">Table for: </div>
                    <input type="text" name="tables" placeholder="Enter the table for:" class="input-responsive" required>


                    <input type="submit" name="submit" value="Confirm Reservation" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

                //check whether button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all  the details from the foem
                    $customer_name = $_POST['customer_name'];
                    $customer_email = $_POST['customer_email'];
                    $customer_contact = $_POST['customer_contact'];
                    $restaurant = $_POST['restaurant'];
                    $tables = $_POST['tables'];
                    $date = date("y-m-d h:i:sa"); //reservation date
                    $status = "Reserved";

                    //save the reservation in database
                    //create sql
                    $sql2 = "INSERT INTO tbl_reservation SET 
                        customer_name = '$customer_name',
                        customer_email = '$customer_email',
                        customer_contact = '$customer_contact',
                        restaurant = '$restaurant',
                        tables = '$tables',
                        date = '$date',
                        status = '$status'

                    ";

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether query executed sucessfully or not
                    if($res2==true)
                    {
                        //query executed and reservation is placed
                        $_SESSION['reserve'] = "<div  class = 'success text-center'><b>Your Reservation is Placed Successfully at $restaurant! 
                            Your name at on your reserved table is: $customer_name.</b></div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //failed to save the reservation
                        $_SESSION['reserve'] = "<div class = 'error text-center'>failed place your reservation.</div>";
                        header('location:'.SITEURL);
                    }

                }
            ?>

        </div>

        </div>
    </section>
    <!--  Section Ends Here -->

<?php include('partials-front/footer.php'); ?> 