<?php
    require 'config.php';
    if(!empty($_SESSION["user_id"])){
        $id = $_SESSION["user_id"];
        $result = mysqli_query($conn,"SELECT * FROM users WHERE user_id = $id");
    
        $row = mysqli_fetch_assoc($result);
        $user_name = $row['user_name'];
    }
    else{
        header("Location: userLogin.php");
    }
?>



<?php

    $id = $_GET['ticket_id'];
    $sql = "SELECT * FROM requisition WHERE req_id = $id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $req_id = $id;
    $requestor = $row['requestor'];
    $contact = $row['contact'];
    $email = $row['email'];
    $date_of_trip = $row['date_of_trip'];
    $destination = $row['destination'];
    $purpose = $row['purpose'];
    $boarding = $row['boarding'];
    $pass_no = $row['pass_no'];
    $date_reserve = $row['date_reserve'];
    $acctno_amnt =  $row['acctno_amnt'];
    $charge =  $row['charge'];

    if(isset($_POST['submit'])){
        $requestor = $_POST['requestor'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $date_of_trip = $_POST['date_of_trip'];
        $destination = $_POST['destination'];
        $purpose = $_POST['purpose'];
        $boarding = $_POST['boarding'];
        $pass_no =$_POST['pass_no'];
        $id = $_GET['ticket_id'];
        $sql = "UPDATE requisition set requestor = '$requestor', contact = '$contact',email = '$email' ,date_of_trip = '$date_of_trip', 
        destination = '$destination', purpose = '$purpose' , boarding = '$boarding', pass_no = $pass_no WHERE req_id = $id";
        $result = mysqli_query($conn,$sql);

        if($result){   
            header('location:adminReservations_review.php?ticket_id='.$id);
        }
        else{
            die(mysqli_error($conn));
        }
    }
?>


<?php
    $id = $_GET['ticket_id'];
    $sql = "SELECT * FROM reservation WHERE req_no = $id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $vehicle = $row['vehicle'];
    $time_from = $row['time_from'];
    $time_to = $row['time_to'];
    $driver = $row['driver'];
    $waiting = $row['waiting'];
    $actual_dt = $row['actual_dt'];
    $odo_out = $row['odo_out'];
    $actual_at = $row['actual_at'];
    $odo_in = $row['odo_in'];
    $guard_on_duty = $row['guard_on_duty'];
    $distance = $row['distance'];
    $gas_rate = $row['gas_rate'];
    $flag_rate = $row['flag_rate'];
    $succ_rate = $row['succ_rate'];
    $wait_rate = $row['wait_rate'];
    $charge_amnt = $row['charge_amnt'];

    if(isset($_POST['submit_odo'])){
        
        $waiting = $_POST['waiting'];   
        $actual_dt = $_POST['actual_dt'];
        $odo_out = $_POST['odo_out'];
        $actual_at =$_POST['actual_at'];
        $odo_in = $_POST['odo_in'];
        $guard_on_duty = $_POST['guard_on_duty'];
        $id = $_GET['ticket_id'];
        

        $distance = $odo_in - $odo_out ;
        $charge_amnt = (($distance - 8) * $succ_rate) + $flag_rate;
        $sql = "UPDATE reservation set waiting = $waiting, actual_dt = '$actual_dt',odo_out = $odo_out ,
        actual_at = '$actual_at', guard_on_duty = '$guard_on_duty' ,distance = $distance, charge_amnt = $charge_amnt,
        odo_in = $odo_in WHERE req_no = $id";
        $result = mysqli_query($conn,$sql);

        if($result){   
            header('location:adminReservations_review.php?ticket_id='.$id);
        }
        else{
            die(mysqli_error($conn));
        }
    }

    if(isset($_POST['submit_accnt'])){
        $acctno_amnt = $_POST['acctno_amnt'];
        $charge = $_POST['charge'];

        $sql = "UPDATE requisition set acctno_amnt = '$acctno_amnt', charge = '$charge'
        WHERE req_id = $id";
        $result = mysqli_query($conn,$sql);

        if($result){   
            header('location:adminCostings_issuance.php?ticket_id='.$id);
        }
        else{
            die(mysqli_error($conn));
        }
    }
?>

<?php

    echo $vehicle;
    $sql = "SELECT * FROM vehicles WHERE v_code = '$vehicle'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $v_code = $row['v_code'];
    $v_name = $row['v_name'];
    $v_seat_cap = $row['v_seat_cap'];
    $v_platenum = $row['v_platenum'];

?>


<!DOCTYPE html>
<html>

    <head>
        <style type = "text/css"></style>
        <meta charset = "utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name = "viewport" content = "width=device-width" initial-scale= 1, shrink-to-fit="no">
        <title>Review Requisition</title>

        <link href="css/styles.css" rel="stylesheet">
        <link href="css/datatables.css" rel="stylesheet">
    </head>

    <body>
        <header>

            <nav>
                <ul>
                    <li>
                        <div class ="text-white">Logged In as: <?php echo  $user_name?></div>
                    </li>
                    <li><a openLogout>Log Out</a></li>
                </ul>
            </nav>
            <div class = "logo-placeholder">
                <img class = "logo-img" src="assets/logo.png">
            </div>

        </header>

        <div class ="card card-sidebar">
            <nav class="sidebar">
                <ul class="ul-vertical">
                    <li><a href="adminDashboard.php">Home</a></li>
                    <li><a href="adminRequisition.php">Requisition</a></li>
                    <li><a href="adminReservations.php">Reservations</a></li>
                    <li><a href="adminTickets.php">Trip Tickets</a></li>
                    <li><a href="adminCostings.php">Costing</a></li>
                    <li><a href="adminVehicles.php">Vehicles</a></li>
                    <li><a href="adminRates.php">Rates</a></li>
                    <li><a href="adminDrivers.php">Drivers</a></li>
                    <li><a href="adminAccounts.php">Accounts</a></li>
                    <li><a href="adminReports.php">Reports</a></li>
                </ul>
            </nav>
        </div>

        <main class="vertical">

            <div class="card">

                <div class="cardHeader">
                    <span class="float-left"><h1>Review Reservation</h1></span>
                </div>

                <div class="cardBody">
                    <div class = "form-row center-items mb-3">
                        <div class="card col-md-4">
                            <div class="cardHeader"><h4>Requisition Number</h4></div>
                            <div class="cardBody"><?php echo  $id?></div>
                        </div>
                        <div class="card col-md-4">
                                <div class="cardHeader"><h4>Date of Trip(s)</h4></div>
                                <div class="cardBody"><?php echo  $date_of_trip?></div>
                        </div>
                        <div class="card col-md-4">
                                <div class="cardHeader"><h4>Date Reserved</h4></div>
                                <div class="cardBody"><?php echo  $date_reserve?></div>
                        </div>
                    </div>

                    <div class = "form-row center-items mb-3">
                        <div class = "card col-md-3">
                            <table>
                                <tr>
                                    <td><b>Requestor:</b></td>
                                    <td><?php echo  $requestor?></td>
                                </tr>
                                <tr>
                                    <td><b>Contact No:</b></td>
                                    <td><?php echo  $contact?></td>
                                </tr>
                                <tr>
                                    <td><b>Email:</b></td>
                                    <td><?php echo  $email?></td>
                                </tr>
                                <tr>
                                    <td><b>Destination:</b></td>
                                    <td><?php echo  $destination?></td>
                                </tr>
                                <tr>
                                    <td><b>Purpose of Trip:</b></td>
                                    <td><?php echo  $purpose?></td>
                                </tr>
                                <tr>
                                    <td><b>Boarding Area:</b></td>
                                    <td><?php echo  $boarding?></td>
                                </tr>
                                <tr>
                                    <td><b>No. of Passenger:</b></td>
                                    <td><?php echo  $pass_no?></td>
                                </tr>
                            </table>
                            <button data-target="requestInfo" class="btn btn-success showButton">Edit Details</button>
                        </div>
                        <div class = "cardBody">
                            <div class = "card mb-3">
                                <table>
                                    <tr>
                                        <th>Vehicle(s)</th>
                                        <th>Brand/Model</th>
                                        <th>Seating Capacity</th>
                                        <th>Plate Number</th>
                                    </tr>
                                    <tr align = "center">
                                        <td><?php echo  $vehicle?></td>
                                        <td><?php echo  $v_name?></td>
                                        <td><?php echo  $v_seat_cap?></td>
                                        <td><?php echo  $v_platenum?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class = "card mb-3">
                                <table class="table-responsive">
                                    <tr>
                                        <td><b>Payment Mode:</b></td>
                                        <td><?php echo  $charge?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Account Name:</b></td>
                                        <td><?php echo  $acctno_amnt?></td>
                                    </tr>
                                </table>
                                <button data-target="accountInfo" class="btn btn-success showButton">Edit Details</button>
                            </div>

                            <!-- Edit Account Details Form-->

                            <div id="accountInfo" class="card hidden mb-3">
                                <div class="cardHeader"><b>Edit Account Details</b></div>
                                <div class="cardBody">
                                    <form method="post">
                                        <table class="table-responsive">
                                            <tr>
                                                <td><b>Payment Mode:</b></td>
                                                <td>
                                                    <select name = "charge" class="form-control">
                                                        <option value="1">Depository</option>
                                                        <option value="3">Cash</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Account Name:</b></td>
                                                <td><select name="acctno_amnt" class="form-control">
                                                    <?php
                                                    $sql = "SELECT accnt_no FROM accounts";
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $accntNumber = $row['accnt_no'];
                                                        echo "<option value='$accntNumber'>$accntNumber</option>";
                                                    }
                                                    ?>
                                                </select>
                                                </td>
                                            </tr>
                                        </table>
                                        <button name = "submit_accnt" type = "submit" class="btn btn-success mb-3">Update</button>
                                    </form>
                                </div>
                            </div>

                            <!-- End of Edit Account Details Form -->
                        </div>
                    </div>

                    <!-- Edit Request Details Form-->
                    <div id="requestInfo" class="card hidden col-md-2 mb-3">
                        <div class="cardHeader"><b>Edit Request Details</b></div>
                        <div class="cardBody">
                            <form method="POST">
                                <table>
                                    <tr>
                                        <td><b>Requestor:</b></td>
                                        <td><input required name="requestor"  value=<?php echo  $requestor?> ></td>
                                    </tr>
                                    <tr>
                                        <td><b>Contact No:</b></td>
                                        <td><input required name="contact"  value=<?php echo  $contact?> ></td>
                                    </tr>
                                    <tr>
                                        <td><b>Destination:</b></td>
                                        <td><input required name="destination"  value=<?php echo  $destination?> ></td>
                                    </tr>
                                    <tr>
                                        <td><b>Purpose of Trip:</b></td>
                                        <td><input required name="purpose"  value=<?php echo  $purpose?>></td>
                                    </tr>
                                    <tr>
                                        <td><b>Boarding Area:</b></td>
                                        <td><input required name="boarding"  value=<?php echo  $boarding?> ></td>
                                    </tr>
                                    <tr>
                                        <td><b>No. of Passenger:</b></td>
                                        <td><input required name="pass_no"  value=<?php echo  $pass_no?> ></td>
                                    </tr>
                                </table>
                                <button name = "submit" type = "submit" class="btn btn-success mb-3">Update</button>
                            </form>
                        </div>
                    </div>

                    <!-- End of Edit Request Details Form-->

                    <div class = "form-row center-items mb-3">
                        <div class="card">
                        <table>
                            <tr>
                                <th>Departure Time</th>
                                <th>Arrival Time</th>
                                <th>Vehicle</th>
                                <th>Driver</th>
                                <th>Action</th>
                            </tr>
                            <tr align ="center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a type= "button" class = "btn btn-danger">Cancel Trip</a></td>
                            </tr>
                        </table>
                        </div>
                        
                    </div>

                    <div class = "form-row float-right">
                        <button class = "btn btn-danger">Cancel Request</button>
                        <button class = "btn btn-success">Assign Driver(s)</button>
                    </div>

                </div> <!-- CARDBODY -->
            </div> <!-- CARD -->
        </main>

        <footer> 

            <div class ="footer-container">
                <div class = "footer-container-2">
                    <div class = "logo-placeholder">
                        <img class = "logo-img" src="assets/logo.png">
                    </div>
                    <div class = "logo-text">
                        &copy; 2023 University of St. La Salle. All rights reserved.
                    </div>
                </div>
            </div>

        </footer>
        <!--LOGOUT MODAL-->
        <dialog modalLogout class="modal">

            <div class="modal-content">
              <div><h1 class="alt">Confirmation</h1></div>
              <div><p class="alt">Are you sure you are ready to Log Out?</p></div>
              <div class="profileBtnContainer">
                  <a class="btn btn-success" href="adminLogin.php">OK</a>
                  <button cancelLogout class="btn btn-danger">Cancel</button>
              </div>
            </div>

        </dialog>

        <script src="js/logoutModal.js"></script>
        <script src="js/hiddenView.js"></script>
        
    </body>
</html>