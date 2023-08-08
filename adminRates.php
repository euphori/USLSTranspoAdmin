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
    $v_type = $_POST["v_type"];
    $v_desc = $_POST["v_desc"];
    $gas_rate = $_POST["gas_rate"];
    $flag_rate = $_POST["flag_rate"];
    $succ_rate = $_POST["succ_rate"];
    $wait_rate = $_POST["wait_rate"];
    $query = "INSERT INTO rates VALUES('', '$v_type','$v_desc','$gas_rate','$flag_rate','$succ_rate','$wait_rate','','','')";
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
                <li><a href="#">Rates</a></li>
                <li><a href="adminDrivers.php">Drivers</a></li>
                <li><a href="adminAccounts.php">Accounts</a></li>
                <li><a href="adminReports.php">Reports</a></li>
            </ul>
            </nav>
            </div>
            <div class="card">
                <div class="cardHeader">
                <span class="float-left"><h1>Rates</h1></span>
                </div>
                <div class="cardBody">
                <button data-target="ratesForm" class = "mb-3 btn btn-success showButton">Create New Rates</button>
                <div id="ratesForm" class="card hidden col-md-2">
                    <div class="cardHeader"><h3 class>Create New Rates</h3></div>
                    <div class="cardBody">
                    <form method="POST">
                            <div class = "form-group">
                                <div class = "form-row">
                                    <div class = "col-md-2">
                                        <label>Vehicle Code</label>
                                        <input required name="v_type" class="form-control" placeholder="Vehicle Code">
                                    </div>
                                    <div class = "col-md-2">
                                         <label>Name/Brand</label>
                                         <input required name="v_desc" class="form-control" placeholder="Vehicle Type">
                                    </div>
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "form-row">
                                    <div class = "col-md-2">
                                        <label>Gas Rate</label>
                                        <input required name="gas_rate" class="form-control" placeholder="Gas Rate">
                                    </div>
                                    <div class = "col-md-2">
                                        <label>Flag-Down Rate</label>
                                        <input required name="flag_rate" class="form-control" placeholder="Flag-Down Rate">
                                    </div>
                                </div>
                            </div>
                            <div class = "form-group">
                                <div class = "form-row">
                                    <div class = "col-md-2">
                                        <label>Succeeding Rate</label>
                                        <input required name="succ_rate" class="form-control" placeholder="Succeeding Rate">
                                    </div>
                                    <div class = "col-md-2">
                                        <label>Waiting Rate</label>
                                        <input required name="wait_rate" class="form-control" placeholder="Waiting Rate">
                                    </div>
                                </div>
                            </div>
                            <button  type="submit" name="submit" class="btn btn-success">Add Record</button>
                        </form>
                    </div>
                </div>
                <div class="table" >
                    <div class="column">
                        <div class="header-cell" >
                            <div class = "text-header-cell">ID</div>
                        </div>
                        <?php
                            $sql = "SELECT * FROM rates";
                            $result = $conn->query($sql);
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $data = $row["rate_id"];
                                    echo '<div class="item-cell">';
                                    echo '<div class="text-item-cell">' .$row["rate_id"]. '</div>';
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
                        <div class="header-cell" >
                            <div class = "text-header-cell">Vehicle Type</div>
                            <button class = "sort-button">
                               <img src = "assets/Sort_arrow_light.png" class = "sort-button-image">
                            </button>
                        </div>
                        <?php
                        $sql = "SELECT * FROM rates";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["v_type"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">' . $row["v_type"] . '</div>';
                                echo '</div>';
                                $counter++;
                            }
                        } else {
                            echo "No data found in the database.";
                        }

                        ?>
                    </div>
                    <div class="column-2">
                        <div class="header-cell" >
                            <div class = "text-header-cell">Gas Rate</div>
                            <button class = "sort-button">
                               <img src = "assets/Sort_arrow_light.png" class = "sort-button-image">
                            </button>
                        </div>
                        <?php
                        $sql = "SELECT * FROM rates";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["gas_rate"];
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
                        <div class="header-cell" >
                            <div class = "text-header-cell">Flag-Down Rate</div>
                            <button class = "sort-button">
                               <img src = "assets/Sort_arrow_light.png" class = "sort-button-image">
                            </button>
                        </div>
                        <?php
                        $sql = "SELECT * FROM rates";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["flag_rate"];
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
                        <div class="header-cell" >
                            <div class = "text-header-cell">Succeeding Rate</div>
                            <button class = "sort-button">
                               <img src = "assets/Sort_arrow_light.png" class = "sort-button-image">
                            </button>
                        </div>
                        <?php
                        $sql = "SELECT * FROM rates";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["succ_rate"];
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
                        <div class="header-cell" >
                            <div class = "text-header-cell">Waiting Rate</div>
                            <button class = "sort-button">
                               <img src = "assets/Sort_arrow_light.png" class = "sort-button-image">
                            </button>
                        </div>
                        <?php
                        $sql = "SELECT * FROM rates";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["wait_rate"];
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
                        <div class="header-cell" >
                            <div class = "text-header-cell">Action</div>
                           
                        </div>
                        <?php
                        $sql = "SELECT * FROM rates";
                        
                            $result = $conn->query($sql);
                            // Loop through the retrieved data and populate the table rows
                            if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
        
                                $data = $row["rate_id"];
                                echo '<div class="item-cell">     
                                    <a class="btn btn-success" href = "updateRates.php?update_id='.$data.'">
                                    Change
                                    </a>
                                    <a class="btn btn-danger" href = "delete.php?r_delete_id='.$data.'">
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