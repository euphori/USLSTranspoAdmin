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
    $d_lname = $_POST["d_lname"];
    $d_fname = $_POST["d_fname"];
    $d_contact = $_POST["d_contact"];
    $d_status = $_POST["d_status"];
    $query = "INSERT INTO drivers VALUES('','', '$d_lname','$d_fname','$d_contact','$d_status','',
    '','','')";
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
                <li><a href="adminReports.php">Reports</a></li>
            </ul>
            </nav>
            </div>
            <div class="card">
                <div class="cardHeader">
                <span class="float-left"><h1>Drivers</h1></span>
                </div>
                <div class="cardBody">
                <button data-target="driverForm"class = "btn btn-success mb-3 showButton">Create a New Record</button>
                <div id="driverForm" class="card hidden col-md-2">
                <div class="cardHeader"><h3>Add a New Account<h3></div>
                    <div class="cardBody">
                        <form method="POST">
                            <div class = "form-group">
                                <div class = "form-row">
                                    <div class = "col-md-2">
                                        <label>Driver's First Name</label>
                                        <input required name="d_fname" class="form-control" placeholder="First Name">
                                    </div>
                                    <div class = "col-md-2">
                                        <label>Driver's Last Name</label>
                                        <input required name="d_lname" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class = "form-group col-md-2">
                                <label>Driver's Contact Number</label>
                                <input required name="d_contact" class="form-control" placeholder="Contact">
                            </div>
                            <div class = "form-group col-md-2">
                                <label>Driver's Status</label> 
                                <select class="form-control" name="d_status">
                                    <option value="regular">Regular</option>
                                    <option value="romac">ROMAC</option>
                                </select>
                            </div>
                        <button  type="submit" name="submit" class="btn btn-success">Add Record</button>
                        </form>
                    </div>
                </div>
                <div class="table-fixed" >
                    <div class="column">
                        <div class="header-cell-sticky" >
                            <div class = "text-header-cell">Driver ID</div>
                        </div>
                        <?php
                            $sql = "SELECT * FROM drivers";
                            $result = $conn->query($sql);
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $data = $row["d_id"];
                                    echo '<div class="item-cell">';
                                    echo '<div class="text-item-cell">' .$row["d_id"]. '</div>';
                                    echo '</div>';
                                    $counter++;
                                }
                            } else {
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">No data found in the database.</div>';
                                echo '</div>';
                            }

                        ?>
        
               
                        
                    </div>
                    <div class="column-2">
                        <div class="header-cell-sticky" >
                            <div class = "text-header-cell">Last Name</div>
                        </div>
                        <?php
                        $sql = "SELECT * FROM drivers";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["d_lname"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">' . $row["d_lname"] . '</div>';
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
                            <div class = "text-header-cell">First Name</div>
                        </div>
                        <?php
                        $sql = "SELECT * FROM drivers";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["d_fname"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">' . $row["d_fname"] . '</div>';
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
                            <div class = "text-header-cell">Contact No.</div>
                        </div>
                        <?php
                        $sql = "SELECT * FROM drivers";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["d_contact"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">' . $row["d_contact"] . '</div>';
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
                            <div class = "text-header-cell">Employment Status</div>
                        </div>
                        <?php
                        $sql = "SELECT * FROM drivers";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["d_status"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">' . $row["d_status"] . '</div>';
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
                            <div class = "text-header-cell">Duty Status</div>
                        </div>
                        <?php
                        $sql = "SELECT * FROM drivers";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["d_mark"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">' . $row["d_mark"] . '</div>';
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
                            <div class = "text-header-cell">Action</div>
                           
                        </div>
                        <?php
                        $sql = "SELECT * FROM drivers";
                        
                            $result = $conn->query($sql);
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["d_id"];
                                echo '<div class="item-cell">
                                    <a class="btn btn-success" href = "updateDrivers.php?update_id=' .$row["d_id"] . '">
                                    Change
                                    </a>
                                    <a class="btn btn-danger" href = "delete.php?d_delete_id='.$row["d_id"].'">
                                    Remove
                                    </a>
                                    </div>
                                    ';
                              
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
        <!--FORM MODAL-->
        <dialog newForm class="modal">
            <div class ="modalContainer">
                
            </div>
        </dialog>
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