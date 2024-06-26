<?php
require 'config.php';
if(!empty($_SESSION["user_id"])){
    $id = $_SESSION["user_id"];
    $result = mysqli_query($conn,"SELECT * FROM users WHERE user_id = $id");
    $row = mysqli_fetch_assoc($result);
    $user_name = $row['user_name'];
}else{
    header("Location: userLogin.php");
}
?>

<?php
$id = $_GET['update_id'];
$sql = "SELECT * FROM drivers WHERE d_id = $id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$d_lname = $row['d_lname'];
$d_fname = $row['d_fname'];
$d_contact = $row['d_contact'];
$d_status = $row['d_status'];
if(isset($_POST['submit'])){
    $d_lname = $_POST['d_lname'];
    $d_fname = $_POST['d_fname'];
    $d_contact = $_POST['d_contact'];
    $d_status = $_POST['d_status'];
    $id = $_GET['update_id'];
    $sql = "UPDATE drivers set d_lname = '$d_lname', d_fname = '$d_fname',d_contact = '$d_contact' ,d_status = '$d_status'WHERE d_id = $id";
    $result = mysqli_query($conn,$sql);

    if($result){
        header('location:adminDrivers.php');
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
                        <div class ="text-white">Logged In as: <?php echo  $user_name?></div>
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
                <li><a href="adminAccounts">Accounts</a></li>
                <li><a href="adminReports.php">Reports</a></li>
            </ul>
            </nav>
            </div>
            <div class="card col-md-2">
                <div class = "cardHeader"><h3>Add a New Account</h3></div>
                <div class="cardBody">
                    <form method="POST">
                    <div class = "form-group">

                        <div class = "form-row">

                            <div class = "col-md-2">
                                <label>Driver's First Name</label>
                                <input value="<?php echo  $d_fname?>" required name="d_fname" class="form-control" placeholder="First Name">
                            </div>
                            <div class = "col-md-2">
                                <label>Driver's Last Name</label>
                                <input value="<?php echo  $d_lname?>" required name="d_lname" class="form-control" placeholder="Last Name">
                            </div>

                        </div>
                        
                        <div class = "col-md-2">
                            <label>Driver's Contact Number</label>
                            <input value="<?php echo  $d_contact?>" required name="d_contact" class="form-control" placeholder="Contact">

                        </div>
                        <div class = "col-md-2">
                                <label>Driver's Status</label> 
                                <select class="form-control" name="d_status">
                                    <option value="Regular">Regular</option>
                                    <option value="ROMAC">ROMAC</option>
                                </select>
                        </div>
                    </div>
                    <button  type="submit" name="submit" class="btn btn-success">Update Record</button>
                    <a type= "button" class="btn btn-danger" href = "adminDrivers.php"> Cancel</a>
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
