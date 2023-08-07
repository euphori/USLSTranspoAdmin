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
        <title>Transport Reservations</title>

        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="userDashboard.php">Dashboard</a></li>
                    <li><a href="userBookings.php">Bookings</a></li>
                    <li><a href="#">Transport Reservations</a></li>
                    <li>
                        <a href="#">Account ⮟</a>
                        <ul class = "dropdown">
                            <li><a href="userProfile.php">Profile</a></li>
                            <li><a openLogout>Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class = "logo-placeholder">
                <img class = "logo-img" src="assets/logo.png">
            </div>  
        </header>
        <main>
            <div class="card">
                <div class="cardHeader"><h1>Transport Reservations</h1></div>
                
            </div>
            <div class="form-field">
                    <div class="search-label" >Search:</div>
                        <input type = "text" placeholder="Search a booking">
                </div>
                <div class="table" >
                    <div class="column">
                        <div class="header-cell" >
                            <div class = "text-header-cell">#</div>
                        </div>
                        <?php
                        $sql = "SELECT v_name from reservation";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["v_name"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">' .$counter. '</div>';
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
                            <div class = "text-header-cell">Vehicle Name</div>
                            <button class = "sort-button">
                               <img src = "assets/Sort_arrow_light.png" class = "sort-button-image">
                            </button>
                        </div>
                        <?php
                        $sql = "SELECT v_name from reservation";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["v_name"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">' . $row["v_name"] . '</div>';
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
                            <div class = "text-header-cell">Driver Name</div>
                           
                        </div>
                        <?php
                        $sql = "SELECT v_driver from reservation";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["v_driver"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">' . $row["v_driver"] . '</div>';
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
                            <div class = "text-header-cell">Reg No.</div>
                           
                        </div>
                        <?php
                        $sql = "SELECT v_reg_no from reservation";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["v_reg_no"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">' . $row["v_reg_no"] . '</div>';
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
                            <div class = "text-header-cell">Seats</div>
                           
                        </div>
                        <?php
                        $sql = "SELECT v_pass_no from reservation";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["v_pass_no"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">' . $row["v_pass_no"] . '</div>';
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
                            <div class = "text-header-cell">Status</div>
                           
                        </div>
                        <?php
                        $sql = "SELECT v_status from reservation";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["v_status"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell">' . $row["v_status"] . '</div>';
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
                        $sql = "SELECT v_id from reservation";
                        $result = $conn->query($sql);
                        // Loop through the retrieved data and populate the table rows
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $data = $row["v_id"];
                                $v_id = $row["v_id"];
                                echo '<div class="item-cell">';
                                echo '<div class="text-item-cell"> 
                                <div>
                                <img class="bookmark-icon" src = assets/Bookmark_fill@3x.png>
                                </div>
                                <a href="confirmRes.php?v_id=' . $v_id . '" >
                                <button  type="button" class="booking-button">
                                <div class="booking-button-text" >Book Now</div>
                                </button>
                                </a></div>';
                                echo '</div>';
                                $counter++;
                            }
                        } else {
                            echo "No data found in the database.";
                        }
                        ?>
        
                        
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
                  <a class="btn btn-success" href="userLogin.php">OK</a>
                  <button cancelLogout class="btn btn-danger">Cancel</button>
              </div>
            </div>
          </dialog>
        <script src="js/logoutModal.js"></script>
    </body>
</html>