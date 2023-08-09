<?php
    require 'config.php';
    if(!empty($_SESSION["user_id"])){
        $id = $_SESSION["user_id"];
        $result = mysqli_query($conn,"SELECT * FROM users WHERE user_id = $id");
        $row = mysqli_fetch_assoc($result);
    }
    else{
        header("Location: userLogin.php");
    }
?>

<?php




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
                        <div class ="text-white">Logged In as: <?php echo  $row["user_name"]?></div>
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
                        <li><a href="#">Reports</a></li>
                    </ul>
                </nav>
            </div>

            <div class="card">

                <div class="cardHeader">
                    <span class="float-left"><h1>Reports</h1></span>
                </div>

                <div class="cardBody">
                    <div class = "cardBody form-row center-items p-top-0 p-bot-0">
                        <a href = "adminReports.php" type = "button" class = "btn btn-success">Overall</a>
                        <a href = "adminReports_category.php"type = "button" class = "btn btn-success">By Category</a>
                        <a href = "adminReports_depo.php" type = "button" class = "btn btn-success">Summary(Depository)</a>
                        <a href = "adminReports_vehicle.php" type = "button" class = "btn btn-success">Summary(Vehicle)</a>
                    </div>
                </div>

                <div class="cardHeader">
                    <span class="float-left"><h3>Generate Report (Overall)</h3></span>
                </div>

                <div class="cardBody">
                    <form name = "reportForm" id="reportform" method="post">
                    <table>
                        <tr>
                            <td>From: <input type = "date" name="start_date" value =""></td>
                            <td>To: <input type = "date" name="end_date" value="" > </td>
                            <td>Sort by:
                                 <select name = "sorting_column"class="">
                                    <option value="req_no">Req No.</option>
                                    <option value="vehicle">Vehicle</option>
                                    <option value="driver">Driver</option>
                                    <option value="date_of_trip">Date of Trip</option>
                                </select>
                            </td>
                            <td><input name="submit" type="submit" class="btn btn-success" value="Generate" onclick=""></td>
                        </tr>
                    </table>
                    </form>


                    <div class="table-fixed" >

                        <div class="column-2">
                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Requisition Number</div>
                            </div>
                            <?php
                                if(isset($_POST['submit'])){
                                    // Define the date range
                                    $start_date = $_POST['start_date'];
                                    $end_date = $_POST['end_date'];
                                    $sorting_column = $_POST['sorting_column'];
                                  
                                    $formated_start_date = date('m/d/Y', strtotime($start_date));
                                    $formated_end_date = date('m/d/Y', strtotime($end_date));
                                    // SQL query to retrieve data between the specified dates
                                    $sql = "SELECT * FROM reservation WHERE date_of_trip BETWEEN '$formated_start_date' AND '$formated_end_date' ORDER BY $sorting_column";
                                    $result = $conn->query($sql);

                                 }
                                // Loop through the retrieved data and populate the table rows
                                if ($result->num_rows > 0) {

                                    while ($row = $result->fetch_assoc()) {
                                        $data = $row["req_no"];
                                        echo '<div class="item-cell">';
                                        echo '<div class="text-item-cell">' .$data. '</div>';
                                        echo '</div>';   
                                        
                                    }
                                } else {
                                    echo "No data found in the database.";
                                }

                            ?>


                            
                        </div>
                        <div class="column-2">
                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Date of Trip</div>
                            </div>
                            <?php

                               if(isset($_POST['submit'])){
                                // Define the date range
                                $start_date = $_POST['start_date'];
                                $end_date = $_POST['end_date'];
                                $sorting_column = $_POST['sorting_column'];
                              
                                $formated_start_date = date('m/d/Y', strtotime($start_date));
                                $formated_end_date = date('m/d/Y', strtotime($end_date));
                                // SQL query to retrieve data between the specified dates
                                $sql = "SELECT * FROM reservation WHERE date_of_trip BETWEEN '$formated_start_date' AND '$formated_end_date' ORDER BY $sorting_column";
                                $result = $conn->query($sql);

                             }
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $data = $row["date_of_trip"];
                                    echo '<div class="item-cell">';
                                    echo '<div class="text-item-cell">' . $data. '</div>';
                                    echo '</div>';
                                    $counter++;
                                  
                                
                                }
                            } else {
                                echo "No data found in the database.";
                            }

                            ?>


                            
                        </div>

                        <div class="column-2">
                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Time From</div>
                            </div>
                            <?php

                               if(isset($_POST['submit'])){
                                // Define the date range
                                $start_date = $_POST['start_date'];
                                $end_date = $_POST['end_date'];
                                $sorting_column = $_POST['sorting_column'];
                              
                                $formated_start_date = date('m/d/Y', strtotime($start_date));
                                $formated_end_date = date('m/d/Y', strtotime($end_date));
                                // SQL query to retrieve data between the specified dates
                                $sql = "SELECT * FROM reservation WHERE date_of_trip BETWEEN '$formated_start_date' AND '$formated_end_date' ORDER BY $sorting_column";
                                $result = $conn->query($sql);

                             }
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $data = $row["time_from"];
                                    echo '<div class="item-cell">';
                                    echo '<div class="text-item-cell">' . $data. '</div>';
                                    echo '</div>';
                                    $counter++;
                                  
                                
                                }
                            } else {
                                echo "No data found in the database.";
                            }

                            ?>


                            
                        </div>
                        <div class="column-2">
                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Time To</div>
                            </div>
                            <?php

                               if(isset($_POST['submit'])){
                                // Define the date range
                                $start_date = $_POST['start_date'];
                                $end_date = $_POST['end_date'];
                                $sorting_column = $_POST['sorting_column'];
                              
                                $formated_start_date = date('m/d/Y', strtotime($start_date));
                                $formated_end_date = date('m/d/Y', strtotime($end_date));
                                // SQL query to retrieve data between the specified dates
                                $sql = "SELECT * FROM reservation WHERE date_of_trip BETWEEN '$formated_start_date' AND '$formated_end_date' ORDER BY $sorting_column";
                                $result = $conn->query($sql);

                             }
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $data = $row["time_to"];
                                    echo '<div class="item-cell">';
                                    echo '<div class="text-item-cell">' . $data. '</div>';
                                    echo '</div>';
                                    $counter++;
                                  
                                
                                }
                            } else {
                                echo "No data found in the database.";
                            }

                            ?>


                            
                        </div>

                        <div class="column-2">
                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Requestor</div>
                            </div>
                            <?php

                               if(isset($_POST['submit'])){
                                // Define the date range
                                $start_date = $_POST['start_date'];
                                $end_date = $_POST['end_date'];
                                $sorting_column = $_POST['sorting_column'];
                              
                                $formated_start_date = date('m/d/Y', strtotime($start_date));
                                $formated_end_date = date('m/d/Y', strtotime($end_date));
                                // SQL query to retrieve data between the specified dates
                                $sql = "SELECT * FROM reservation WHERE date_of_trip BETWEEN '$formated_start_date' AND '$formated_end_date' ORDER BY $sorting_column";
                                $result = $conn->query($sql);

                             }
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $data = $row["requestor"];
                                    echo '<div class="item-cell">';
                                    echo '<div class="text-item-cell">' . $data. '</div>';
                                    echo '</div>';
                                    $counter++;
                                  
                                
                                }
                            } else {
                                echo "No data found in the database.";
                            }

                            ?>


                            
                        </div>

                        <div class="column-2">
                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Vehicle</div>
                            </div>
                            <?php

                               if(isset($_POST['submit'])){
                                // Define the date range
                                $start_date = $_POST['start_date'];
                                $end_date = $_POST['end_date'];
                                $sorting_column = $_POST['sorting_column'];
                              
                                $formated_start_date = date('m/d/Y', strtotime($start_date));
                                $formated_end_date = date('m/d/Y', strtotime($end_date));
                                // SQL query to retrieve data between the specified dates
                                $sql = "SELECT * FROM reservation WHERE date_of_trip BETWEEN '$formated_start_date' AND '$formated_end_date'  ORDER BY $sorting_column";
                                $result = $conn->query($sql);

                             }
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $data = $row["vehicle"];
                                    echo '<div class="item-cell">';
                                    echo '<div class="text-item-cell">' . $data. '</div>';
                                    echo '</div>';
                                    $counter++;
                                  
                                
                                }
                            } else {
                                echo "No data found in the database.";
                            }

                            ?>


                            
                        </div>
                        <div class="column-2">
                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Destination</div>
                            </div>
                            <?php

                               if(isset($_POST['submit'])){
                                // Define the date range
                                $start_date = $_POST['start_date'];
                                $end_date = $_POST['end_date'];
                                $sorting_column = $_POST['sorting_column'];
                              
                                $formated_start_date = date('m/d/Y', strtotime($start_date));
                                $formated_end_date = date('m/d/Y', strtotime($end_date));
                                // SQL query to retrieve data between the specified dates
                                $sql = "SELECT * FROM reservation WHERE date_of_trip BETWEEN '$formated_start_date' AND '$formated_end_date' ORDER BY $sorting_column";
                                $result = $conn->query($sql);

                             }
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $data = $row["destination"];
                                    echo '<div class="item-cell">';
                                    echo '<div class="text-item-cell">' . $data. '</div>';
                                    echo '</div>';
                                    $counter++;
                                  
                                
                                }
                            } else {
                                echo "No data found in the database.";
                            }

                            ?>


                            
                        </div>

                        <div class="column-2">
                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Driver</div>
                            </div>
                            <?php

                            if(isset($_POST['submit'])){
                                // Define the date range
                                $start_date = $_POST['start_date'];
                                $end_date = $_POST['end_date'];
                                $sorting_column = $_POST['sorting_column'];
                            
                                $formated_start_date = date('m/d/Y', strtotime($start_date));
                                $formated_end_date = date('m/d/Y', strtotime($end_date));
                                // SQL query to retrieve data between the specified dates
                                $sql = "SELECT * FROM reservation WHERE date_of_trip BETWEEN '$formated_start_date' AND '$formated_end_date'  ORDER BY $sorting_column";
                                $result = $conn->query($sql);

                            }
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                  
                                    $data = $row["driver"];
                                    echo '<div class="item-cell">';
                                    echo '<div class="text-item-cell">' . $data. '</div>';
                                    echo '</div>';
                                    $counter++;
                                    
                                }
                            } else {
                                echo "No data found in the database.";
                            }

                            ?>


                            
                        </div>
                        <div class="column-2">
                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Charges</div>
                            </div>
                            <?php
                            if(isset($_POST['submit'])){
                                // Define the date range
                                $start_date = $_POST['start_date'];
                                $end_date = $_POST['end_date'];
                                $sorting_column = $_POST['sorting_column'];
                              
                                $formated_start_date = date('m/d/Y', strtotime($start_date));
                                $formated_end_date = date('m/d/Y', strtotime($end_date));
                                // SQL query to retrieve data between the specified dates
                                $sql = "SELECT * FROM reservation WHERE date_of_trip BETWEEN '$formated_start_date' AND '$formated_end_date'  ORDER BY $sorting_column";
                                $result = $conn->query($sql);

                             }
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                   
                                        $data = $row["charge_amnt"];
                                    echo '<div class="item-cell">';
                                    echo '<div class="text-item-cell">' . $data. '</div>';
                                    echo '</div>';
                                    $counter++;
                                   
                                
                                }
                            } else {
                                echo "No data found in the database.";
                            }

                            ?>


                            
                        </div>



                        <div class="column-2">
                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Acct./Or.</div>
                            </div>
                            <?php
                                
                               if(isset($_POST['submit'])){
                                // Define the date range
                                $start_date = $_POST['start_date'];
                                $end_date = $_POST['end_date'];
                                $sorting_column = $_POST['sorting_column'];
                              
                                $formated_start_date = date('m/d/Y', strtotime($start_date));
                                $formated_end_date = date('m/d/Y', strtotime($end_date));
                                // SQL query to retrieve data between the specified dates
                                $sql = "SELECT * FROM reservation WHERE date_of_trip BETWEEN '$formated_start_date' AND '$formated_end_date' ORDER BY $sorting_column";
                                $result = $conn->query($sql);

                             }
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $data = $row["acctno_amnt"];
                                    echo '<div class="item-cell">';
                                    echo '<div class="text-item-cell">' . $data. '</div>';
                                    echo '</div>';
                                    $counter++;
                                  
                                
                                }
                            } else {
                                echo "No data found in the database.";
                            }

                            ?>


                            
                        </div>

                        </div>

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