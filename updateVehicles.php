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
$sql = "SELECT * FROM vehicles WHERE v_id = $id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$v_code = $row['v_code'];
$v_name = $row['v_name'];
$v_model = $row['v_model'];
$v_platenum = $row['v_platenum'];
$v_seat_cap = $row['v_seat_cap'];
$v_type = $row['v_type'];
$usage_rights = $row['usage_rights'];

if(isset($_POST['submit'])){
    $v_code = $_POST['v_code'];
    $v_name = $_POST['v_name'];
    $v_model = $_POST['v_model'];
    $v_platenum = $_POST['v_platenum'];
    $v_seat_cap = $_POST['v_seat_cap'];
    $v_type = $_POST['v_type'];
    $usage_rights = $_POST['usage_rights'];
    $id = $_GET['update_id'];
    $sql = "UPDATE vehicles set v_code = '$v_code', v_name = '$v_name',v_model = '$v_model' ,v_platenum = '$v_platenum', v_seat_cap = $v_seat_cap, v_type = '$v_type',usage_rights = '$usage_rights' WHERE v_id = $id";
    $result = mysqli_query($conn,$sql);

    if($result){
        header('location:adminVehicles.php');
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
                <div class="cardHeader"><h3>Add a New Vehicle</h3></div>
                <div class="cardBody">
                    <form method="POST">
                        <div class = "form-group">
                            <div class = "form-row">
                                <div class = "col-md-2">
                                    <label>Vehicle Code</label>
                                    <input value="<?php echo  $v_code?>"  required name="v_code" class="form-control" placeholder="Vehicle Code">
                                </div>
                                <div class = "col-md-2">
                                    <label>Name/Brand</label>
                                    <input value="<?php echo  $v_name?>" required name="v_name" class="form-control" placeholder="Name/Brand">
                                </div>
                            </div>
                        </div>
                        <div class = "form-group">
                            <div class = "form-row">
                                <div class = "col-md-2">
                                    <label>Model/Series</label>
                                    <input value="<?php echo  $v_model?>" required name="v_model" class="form-control" placeholder="Model/Series">
                                </div>
                                <div class = "col-md-2">
                                    <label>Plate Number</label> 
                                    <input value="<?php echo  $v_platenum?>" required name="v_platenum" class="form-control" placeholder="Plate Number">
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
                            <input value=<?php echo  $v_seat_cap?> required name="v_seat_cap" class="form-control" placeholder="Seating Capacity">
                        </div>
                        <button  type="submit" name="submit" class="btn btn-success">Update Record</button>
                        <a type= "button" class="btn btn-danger" href = "adminVehicles.php"> Cancel</a>
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
