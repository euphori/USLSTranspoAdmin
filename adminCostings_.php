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
                <span class="float-left"><h1>Review Reservation</h1></span>
                </div>
                <div class="cardBody">
                    <div class = "form-row center-items mb-3">
                        <div class="card col-md-4">
                            <div class="cardHeader"><h4>Requisition Number</h4></div>
                            <div class="cardBody"></div>
                    </div>
                    <div class="card col-md-4">
                            <div class="cardHeader"><h4>Date of Trip(s)</h4></div>
                            <div class="cardBody"></div>
                    </div>
                    <div class="card col-md-4">
                            <div class="cardHeader"><h4>Date Reserved</h4></div>
                            <div class="cardBody"></div>
                    </div>
                </div>
                <div class = "form-row center-items mb-3">
                    <div class = "card col-md-3">
                        <table>
                            <tr>
                                <td><b>Requestor:</b></td>
                                <td>Mister Big</td>
                            </tr>
                            <tr>
                                <td><b>Contact No:</b></td>
                                <td>Mister Big</td>
                            </tr>
                            <tr>
                                <td><b>Email:</b></td>
                                <td>Mister Big</td>
                            </tr>
                            <tr>
                                <td><b>Destination:</b></td>
                                <td>Mister Big</td>
                            </tr>
                            <tr>
                                <td><b>Purpose of Trip:</b></td>
                                <td>Mister Big</td>
                            </tr>
                            <tr>
                                <td><b>Boarding Area:</b></td>
                                <td>Mister Big</td>
                            </tr>
                            <tr>
                                <td><b>No. of Passenger:</b></td>
                                <td>Mister Big</td>
                            </tr>
                        </table>
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
                                    <td>A</td>
                                    <td>B</td>
                                    <td>C</td>
                                    <td>D</td>
                                </tr>
                                
                            </table>
                        </div>
                        <div class = "card">
                            <table>
                                <tr>
                                    <th>Payment Mode</th>
                                    <th>Check/OR #</th>
                                </tr>
                                <tr align = "center">
                                    <td>Office Account</td>
                                    <td>123456</td>
                                </tr>
                            </table>
                        </div>
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
                <div class = "form-row float-right">
                    <button class = "btn btn-danger">Cancel Request</button>
                    <button class = "btn btn-success">Assign Driver(s)</button>
                </div>
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
    </body>
</html>