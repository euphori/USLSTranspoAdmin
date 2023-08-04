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
        <main class="vertical">
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
            <div class="card">
                <div class="cardHeader">
                <span class="float-left"><h1>Requisition (Bed Rooms)</h1></span>
                </div>
                <div class = "cardBody form-row">
                    <a href="adminRequisition.php" type = "button" class = "btn btn-success">Back</a>
                </div>
                <div class="cardBody">
                    <form name = "req_form" id = "req_form" action="" method="post">
                        <div class = "card">
                            <table>
                                <tr>
                                    <td>Requisition Type:</td>
                                    <td>
                                        <select name = "req_type" >
                                            <option value = "1" selected>Regular</option>
                                            <option value = "2" >Special</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date of Trip:</td>
                                    <td><input name="req_date" type = "date" onchange="this.form.submit()"></td>
                                </tr>
                                <tr>
                                    <td>Departure Time:
                                    <select name="time_start" onchange="this.form.submit()">
                                        <option value="1" selected="">12:00 AM</option>
                                        <option value="3">1:00 AM</option>
                                        <option value="5">2:00 AM</option>
                                        <option value="7">3:00 AM</option>
                                        <option value="9">4:00 AM</option>
                                        <option value="11">5:00 AM</option>
                                        <option value="13">6:00 AM</option>
                                    </select>
		                                
                                     </td>
                                     <td>Arrival Time: <select name="time_end" onchange="this.form.submit()">
                                        <option value="43" selected="">12:00 AM</option>
                                        <option value="45">1:00 AM</option>
                                        <option value="47">2:00 AM</option>
                                     </td>
                                    <td align="right">
                                        <input type="submit" name="r_sked" class="btn btn-success" value = "Reserve Selected Dates">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
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