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
if(isset($_POST["submit"])){
    $v_code = $_POST["v_code"];
    $v_name = $_POST["v_name"];
    $v_model = $_POST["v_model"];
    $v_platenum = $_POST["v_platenum"];
    $v_type = $_POST["v_type"];
    $usage_rights = $_POST["usage_rights"];
    $v_seat_cap = $_POST["v_seat_cap"];
    $query = "INSERT INTO vehicles VALUES('', '$v_code','$v_name','$v_model','$v_platenum','$v_seat_cap','$v_type','','','','','$usage_rights','','','','')";
    mysqli_query($conn,$query);
    echo
    "<script> alert('Added'); </script>";

}
?>

<!DOCTYPE html>
<html>

    <head>
        <style type = "text/css"></style>
        <meta charset = "utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name = "viewport" content = "width=device-width" initial-scale= 1, shrink-to-fit="no">
        <title>Vehicles</title>

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
                        <li><a href="adminReports.php">Reports</a></li>
                    </ul>
                </nav>

            </div>

            <div class="card">

                <div class="cardHeader">
                <span class="float-left"><h1>Vehicles</h1></span>
                </div>

                <div class="cardBody">
                    <button data-target="vehicleForm" class="btn btn-success showButton mb-3">Create New Record</button>

                    <!-- ADD NEW VEHICLE FORM -->
                
                    <div id="vehicleForm" class="card col-md-2 mb-3 hidden">
                        <div class="cardHeader"><h3>Add a New Vehicle</h3></div>
                        <div class="cardBody">
                            <form method="POST">
                                <div class = "form-group">
                                    <div class = "form-row">
                                        <div class = "col-md-2">
                                            <label>Vehicle Code</label>
                                            <input required name="v_code" class="form-control" placeholder="Vehicle Code">
                                        </div>
                                        <div class = "col-md-2">
                                            <label>Name/Brand</label>
                                            <input required name="v_name" class="form-control" placeholder="Name/Brand">
                                        </div>
                                    </div>
                                </div>
                                <div class = "form-group">
                                    <div class = "form-row">
                                        <div class = "col-md-2">
                                            <label>Model/Series</label>
                                            <input required name="v_model" class="form-control" placeholder="Model/Series">
                                        </div>
                                        <div class = "col-md-2">
                                            <label>Plate Number</label> 
                                            <input required name="v_platenum" class="form-control" placeholder="Plate Number">
                                        </div>
                                    </div>
                                </div>
                                <div class = "form-group">
                                    <div class = "form-row">
                                        <div class = "col-md-2">
                                        <label>Vehicle Type</label> 
                                        <select class="form-control" name="v_type">
                                            <option value="aircon_bus">Aircon Bus</option>
                                            <option value="nonair_bus">Non Aircon Bus</option>
                                            <option value="nonair_van">Van</option>
                                            <option value="aircon_van">Aircon Van</option>
                                        </select>
                                        </div>
                                        <div class = "col-md-2">
                                        <label>Usage Rights</label> 
                                        <select class="form-control" name="usage_rights">
                                            <option value=1>ALL</option>
                                            <option value=2>VC's & ADMIN</option>
                                            <option value=3>ADMIN ONLY</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class = "form-group col-md-3">
                                    <label>Seating Capacity</label> 
                                    <input required name="v_seat_cap" class="form-control" placeholder="Seating Capacity">
                                </div>
                                <div class = "form-group">
                                    <button type="submit" name="submit" class="btn btn-success">Add Record</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- END OF NEW VEHICLE FORM -->

                    <div class="table-fixed" >
                        
                        <div class="column-2">

                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Vehicle Code</div>
                            </div>

                            <?php

                                $sql = "SELECT * FROM vehicles";
                                $result = $conn->query($sql);
                                // Loop through the retrieved data and populate the table rows
                                if ($result->num_rows > 0) {
                                    $counter = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $data = $row["v_code"];
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
                                <div class = "text-header-cell">Name / Brand</div>
                            </div>

                            <?php

                                $sql = "SELECT * FROM vehicles";
                                $result = $conn->query($sql);
                                // Loop through the retrieved data and populate the table rows
                                if ($result->num_rows > 0) {
                                    $counter = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $data = $row["v_name"];
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
                                <div class = "text-header-cell">Model/Series</div>
                            </div>

                            <?php

                                $sql = "SELECT * FROM vehicles";
                                $result = $conn->query($sql);
                                // Loop through the retrieved data and populate the table rows
                                if ($result->num_rows > 0) {
                                    $counter = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $data = $row["v_model"];
                                        echo '<div class="item-cell">';
                                        echo '<div class="text-item-cell">' . $data. '</div>';
                                        echo '</div>';
                                        $counter++;
                                    }
                                } 
                                else {
                                    echo "No data found in the database.";
                                }

                            ?>
            
                
                            
                        </div>
                        <div class="column-2">

                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Plate Number</div>
                            </div>

                            <?php

                                $sql = "SELECT * FROM vehicles";
                                $result = $conn->query($sql);
                                // Loop through the retrieved data and populate the table rows
                                if ($result->num_rows > 0) {
                                    $counter = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $data = $row["v_platenum"];
                                        echo '<div class="item-cell">';
                                        echo '<div class="text-item-cell">' . $data. '</div>';
                                        echo '</div>';
                                        $counter++;
                                    }
                                } 
                                else {
                                    echo "No data found in the database.";
                                }

                            ?>
            
                        </div>
                        <div class="column-2">

                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Seating Capacity</div>
                            </div>

                            <?php

                                $sql = "SELECT * FROM vehicles";
                                $result = $conn->query($sql);
                                // Loop through the retrieved data and populate the table rows
                                if ($result->num_rows > 0) {
                                    $counter = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $data = $row["v_seat_cap"];
                                        echo '<div class="item-cell">';
                                        echo '<div class="text-item-cell">' . $data. '</div>';
                                        echo '</div>';
                                        $counter++;
                                    }
                                } 

                                else {
                                    echo "No data found in the database.";
                                }

                            ?>

                        </div>

                        <div class="column-2">

                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Type</div>
                            </div>

                            <?php

                                $sql = "SELECT * FROM vehicles";
                                $result = $conn->query($sql);
                                // Loop through the retrieved data and populate the table rows
                                if ($result->num_rows > 0) {
                                    $counter = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $data = $row["v_type"];
                                        echo '<div class="item-cell">';
                                        echo '<div class="text-item-cell">' . $data. '</div>';
                                        echo '</div>';
                                        $counter++;
                                    }
                                } 
                                else {
                                    echo "No data found in the database.";
                                }

                            ?>
    
                        </div>

                        <div class="column-2">

                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Status</div>
                            </div>

                            <?php
                                $sql = "SELECT * FROM vehicles";
                                $result = $conn->query($sql);
                                // Loop through the retrieved data and populate the table rows
                                if ($result->num_rows > 0) {
                                    $counter = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $data = $row["v_status"];
                                        if($data == 1){
                                            $data = 'Available';
                                        }else{
                                            $data = 'Unvailable';
                                        }
                                        echo '<div class="item-cell">';
                                        echo '<div class="text-item-cell">' . $data. '</div>';
                                        echo '</div>';
                                        $counter++;
                                    }
                                } 
                                else {
                                    echo "No data found in the database.";
                                }

                            ?>
            
                        </div>       
                        
                        <div class="column-2">

                            <div class="header-cell-sticky" >
                                <div class = "text-header-cell">Action</div>
                            </div>

                            <?php

                                $sql = "SELECT * FROM vehicles";
                                $result = $conn->query($sql);
                                // Loop through the retrieved data and populate the table rows
                                if ($result->num_rows > 0) {
                                    $counter = 1;
                                    while ($row = $result->fetch_assoc()) {
                
                                        $data = $row["v_id"];
                                        echo '<div class="item-cell">     
                                            <a class="btn btn-success" href = "updateVehicles.php?update_id='.$data.'">
                                            Change
                                            </a>
                                            <a class="btn btn-danger" href = "delete.php?v_delete_id='.$data.'">
                                            Remove
                                            </a>
                                        
                                            
                                            </div>
                                            ';
                                    
                                        $counter++;
                                    }
                                } 
                                else {
                                echo "No data found in the database.";
                                }

                            ?>

                        </div>

                    </div> <!-- TABLE -->
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
            <div class="modalContainer">
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