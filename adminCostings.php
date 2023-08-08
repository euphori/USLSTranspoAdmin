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
                <li><a href="#">Costing</a></li>
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
                <span class="float-left"><h1>Costing</h1></span>
                </div>
                <div class="cardBody">
                <div class="table-fixed" >

                <div class="column-2">
                    <div class="header-cell-sticky" >
                        <div class = "text-header-cell">Requisition Number</div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM reservation";
                    $result = $conn->query($sql);
                    // Loop through the retrieved data and populate the table rows
                    if ($result->num_rows > 0) {
                        $counter = 1;
                        while ($row = $result->fetch_assoc()) {
                            if($row["res_mark"] == 1){
                              $data = $row["req_no"];
                            echo '<div class="item-cell">';
                            echo '<div class="text-item-cell">' .$data. '</div>';
                            echo '</div>';
                            $counter++;  
                            }
                            
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
                    $sql = "SELECT * FROM reservation";
                    $result = $conn->query($sql);
                    // Loop through the retrieved data and populate the table rows
                    if ($result->num_rows > 0) {
                        $counter = 1;
                        while ($row = $result->fetch_assoc()) {
                            if($row["res_mark"] == 1){
                                 $data = $row["date_of_trip"];
                            echo '<div class="item-cell">';
                            echo '<div class="text-item-cell">' . $data. '</div>';
                            echo '</div>';
                            $counter++;
                            }
                           
                        }
                    } else {
                        echo "No data found in the database.";
                    }

                    ?>


                    
                </div>
                
                <div class="column-2">
                    <div class="header-cell-sticky" >
                        <div class = "text-header-cell">Date Reserved</div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM reservation";
                    $result = $conn->query($sql);
                    // Loop through the retrieved data and populate the table rows
                    if ($result->num_rows > 0) {
                        $counter = 1;
                        while ($row = $result->fetch_assoc()) {
                            if($row["res_mark"] == 1){
                                $data = $row["date_reserve"];
                            echo '<div class="item-cell">';
                            echo '<div class="text-item-cell">' . $data. '</div>';
                            echo '</div>';
                            $counter++;
                            }
                            
                        }
                    } else {
                        echo "No data found in the database.";
                    }

                    ?>


                    
                </div>
                <div class="column-2">
                    <div class="header-cell-sticky" >
                        <div class = "text-header-cell">Reservation(s) of</div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM reservation";
                    $result = $conn->query($sql);
                    // Loop through the retrieved data and populate the table rows
                    if ($result->num_rows > 0) {
                        $counter = 1;
                        while ($row = $result->fetch_assoc()) {
                            if($row["res_mark"] == 1){
                                   $data = $row["requestor"];
                            echo '<div class="item-cell">';
                            echo '<div class="text-item-cell">' . $data. '</div>';
                            echo '</div>';
                            $counter++;
                            }
                         
                        }
                    } else {
                        echo "No data found in the database.";
                    }

                    ?>


                    
                </div>



                <div class="column-2">
                    <div class="header-cell-sticky" >
                        <div class = "text-header-cell">Action</div>
                    
                    </div>
                    <?php
                    $sql = "SELECT * FROM reservation";
                    
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                        $counter = 1;
                        while ($row = $result->fetch_assoc()) {
                            if($row["res_mark"] == 1){
                               $data = $row["req_no"];
                            echo '<div class="item-cell">     
                                <a class="btn btn-success" href = "adminCostings_compute.php?ticket_id='.$data.'">
                                View Request
                                </a>
                                <a class="btn btn-success" href = "delete.php?r_delete_id='.$data.'">
                                Trip Ticket
                                </a>
                            
                                
                                </div>
                                ';
                        
                            $counter++; 
                            }

                            
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