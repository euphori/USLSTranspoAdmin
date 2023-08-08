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
$id = $_GET['update_id'];
$sql = "SELECT * FROM rates WHERE rate_id = $id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$v_type = $row['v_type'];
$v_desc = $row['v_desc'];
$gas_rate = $row['gas_rate'];
$flag_rate = $row['flag_rate'];
$succ_rate = $row['succ_rate'];
$wait_rate = $row['wait_rate'];
if(isset($_POST['submit'])){
    $v_type = $_POST['v_type'];
    $v_desc = $_POST['v_desc'];
    $gas_rate = $_POST['gas_rate'];
    $flag_rate = $_POST['flag_rate'];
    $succ_rate = $_POST['succ_rate'];
    $wait_rate = $_POST['wait_rate'];
    $id = $_GET['update_id'];
    $sql = "UPDATE rates set v_type = '$v_type', v_desc = '$v_desc',gas_rate = $gas_rate ,flag_rate = $flag_rate, succ_rate = $succ_rate, wait_rate = $wait_rate WHERE rate_id = $id";
    $result = mysqli_query($conn,$sql);

    if($result){
        header('location:adminRates.php');
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
            <div class="card col-md-2">
                <div class="cardHeader"><h3>Update Rate</h3></div>
                <div class="cardBody">
                    <form method="POST">
                        <div class = "form-group">
                            <div class = "form-row">
                                <div class = "col-md-2">
                                    <label class="alt">Vehicle Code</label>
                                    <input value="<?php echo  $v_type?>" required name="v_type" class="form-control" placeholder="Vehicle Code">
                                </div>
                                <div class = "col-md-2">
                                    <label class="alt">Name/Brand</label>
                                    <input value="<?php echo  $v_desc?>" required name="v_desc" class="form-control" placeholder="Vehicle Type">
                                </div>
                            </div>
                        </div>
                        <div class = "form-group">
                            <div class = "form-row">
                                <div class = "col-md-2">
                                    <label class="alt">Gas Rate</label>
                                    <input value="<?php echo  $gas_rate?>" required name="gas_rate" class="form-control" placeholder="Gas Rate">
                                </div>
                                <div class = "col-md-2">
                                    <label class="alt">Flag-Down Rate</label>
                                    <input value="<?php echo  $flag_rate?>" required name="flag_rate" class="form-control" placeholder="Flag-Down Rate">
                                </div>
                            </div>
                        </div>
                        <div class = "form-group">
                            <div class = "form-row">
                                <div class = "col-md-2">
                                    <label class="alt">Succeeding Rate</label>
                                    <input value="<?php echo  $succ_rate?>" required name="succ_rate" class="form-control" placeholder="Succeeding Rate">
                                </div>
                                <div class = "col-md-2">
                                    <label class="alt">Waiting Rate</label>
                                    <input value="<?php echo  $wait_rate?>" required name="wait_rate" class="form-control" placeholder="Waiting Rate">
                                </div>
                            </div>
                        </div>
                        <button  type="submit" name="submit" class="btn btn-success">Update Record</button>
                        <a type= "button" class="btn btn-danger" href = "adminRates.php"> Cancel</a>
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

        


        
    </body>
</html>
