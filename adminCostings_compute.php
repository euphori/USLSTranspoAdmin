<?php
require 'config.php';
if(!empty($_SESSION["user_id"])){
    $id = $_SESSION["user_id"];
    $result = mysqli_query($conn,"SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);
}else{
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
        header('location:adminCostings_compute.php?ticket_id='.$id);
    }else{
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <style type = "text/css"></style>
        <meta charset = "utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name = "viewport" content = "width=device-width" initial-scale= 1, shrink-to-fit="no">
        <title>Dashboard</title>

        <link href="css/styles.css" rel="stylesheet">
        <link href="css/datatables.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li>
                        <div class ="text-white">Logged In as: <!--?php echo  $row["a_email"]?--></div>
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
                <span class="float-left"><h1>Compute Costing</h1></span>
                </div>
                <div class="cardBody">
                    <div class = "form-row center-items mb-3">
                        <div class="card col-md-4">
                            <div class="cardHeader"><h4>Requisition Number</h4></div>
                            <div class="cardBody"> <?php echo  $req_id?></div>
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
                <div class = "form-row">
                    <div class = "card col-md-2">
                    <div class="cardHeader"><h3>Request Details</h3></div>
                        <table>
                            <tr>
                                <td><b>Requestor: <?php echo  $requestor?></b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Contact No: <?php echo  $contact?></b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Destination: <?php echo  $destination?></b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Purpose of Trip: <?php echo  $purpose?></b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Boarding Area: <?php echo  $boarding?></b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>No. of Passenger: <?php echo  $pass_no?></b></td>
                                <td></td>
                            </tr>
                        </table>
                        <button data-target="requestInfo" class="btn btn-success showButton">Edit Details</button>
                    </div>
                    <!--Hidden Form-->
                <div id="requestInfo" class="card hidden col-md-3 mb-3">
                    <div class="cardHeader"><b>Edit Request Details</b></div>
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
                <!--Hidden Form-->
                </div>
                <div class = "cardBody">
                        <div class = "card mb-3">
                            <table>
                                <tr>
                                    <th>Departure</th>
                                    <th>Arrival</th>
                                    <th>Vehicle(s)</th>
                                    <th>Driver</th>
                                </tr>
                                <tr align = "center">
                                    <td>A</td>
                                    <td>B</td>
                                    <td>C</td>
                                    <td>D</td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
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
                            <td>8:00 AM</td>
                            <td>5:00 PM</td>
                            <td>Avanza</td>
                            <td>Don Quixote</td>
                            <td><a type= "button" class = "btn btn-danger">Cancel Trip</a></td>
                        </tr>
                    </table>
                    </div>
                </div>
                <div class = "form-row center-items mb-3">
                    <div class="card">
                    <table>
                        <tr>
                            <th>Vehicle Code</th>
                            <th>Actual Departure Time</th>
                            <th>Odometer (Out)</th>
                            <th>Actual Arrival Time</th>
                            <th>Odometer (In)</th>
                            <th>Waiting Time</th>
                            <th>Guard on Duty</th>
                            <th>Action</th>
                        </tr>
                        <tr align ="center">
                            <td>INN</td>
                            <td>8:32 AM</td>
                            <td>277148</td>
                            <td>5:37 PM</td>
                            <td>277185</td>
                            <td>2</td>
                            <td>Teddy Long</td>
                            <td><button data-target="costForm" class = "btn btn-success showButton">Add/Edit</button></td>
                        </tr>
                    </table>
                    </div>
                </div>
                <!--Hidden Form-->
                <div id="costForm" class = "form-row hidden center-items mb-3">
                    <div class="card">
                    <form method="post">
                    <table>
                        <tr>
                            <th>Vehicle Code</th>
                            <th>Actual Departure Time</th>
                            <th>Odometer (Out)</th>
                            <th>Actual Arrival Time</th>
                            <th>Odometer (In)</th>
                            <th>Waiting Time</th>
                            <th>Guard on Duty</th>
                            <th>Action</th>
                        </tr>
                        <tr align ="center">
                            <td>INN</td>
                            <td><input required name="departure" class="form-control col-md-2" value="" ></td>
                            <td><input required name="odo_out" class="form-control col-md-2" value="" ></td>
                            <td><input required name="arrival" class="form-control col-md-2" value="" ></td>
                            <td><input required name="odo_in" class="form-control col-md-2" value="" ></td>
                            <td><input required name="wait_time" class="form-control col-md-2" value="" ></td>
                            <td><input required name="driver" class="form-control col-md-2" value="" ></td>
                            <td><button type= "submit" class = "btn btn-success">Update</a></td>
                        </tr>
                    </table>
                    </form>
                    </div>
                </div>
                <!--Hidden Form-->
                <div class = "form-row center-items mb-3">
                    <div class="card">
                    <table class="mb-3">
                        <tr>
                            <th>Vehicle(s)</th>
                            <th>Distance</th>
                            <th>Charges</th>
                        </tr>
                        <tr align ="center">
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                    <table>
                        <td><b>Total Charges<b></td>
                        <th>0.00</th>
                    </table>
                    </div>
                <div class = "card">
                            <table class="or_name">
                                <tr>
                                    <th>Account Name</th>
                                    <th>Payment Mode</th>
                                    <th>Account #/OR #</th>
                                    <th>Amount</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                
                                <tr align = "center">
                                <form method="post">
                                <td><input readonly name="account" class="form-control col-md-1" value=""></td>
                                    <td>
                                        <select class="form-control">
                                            <option value="depository">Depository</option>
                                            <option value="cash">Cash</option>
                                        </select>
                                    </td>
                                    <td><input required name="or_num" class="form-control col-md-2" value=""></td>
                                    <td><input required name="amount" class="form-control col-md-2" value=""></td>
                                    <td><input name="update_or" type="submit" class="btn btn-success" value="Update"></td>
                                    <td><input name="excelreport" type="submit" class="btn btn-success" value="Generate Statement"></td>
                                    </form>
                                </tr>
                                
                            </table>
                        </div>
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