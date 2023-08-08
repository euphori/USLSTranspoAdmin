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
$sql = "SELECT * FROM accounts WHERE accnt_id = $id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$accnt_name = $row['accnt_name'];
$accnt_no = $row['accnt_no'];
if(isset($_POST['submit'])){
    $accnt_no = $_POST['accnt_no'];
    $accnt_name = $_POST['accnt_name'];
    $id = $_GET['update_id'];
    $sql = "UPDATE accounts set accnt_no = '$accnt_no', accnt_name = '$accnt_name' WHERE accnt_id = $id";
    $result = mysqli_query($conn,$sql);

    if($result){
        header('location:adminAccounts.php');
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
            <div class="card col-md-2">
                <div class="cardHeader"><h3>Update Account</h3></div>
                <div class="cardBody">
                    <form method="POST">
                        <div class = "form-group">
                            <div class = "form-row">
                                <div class = "col-md-2">
                                    <label>Account Number</label>
                                    <input required value = "<?php echo  $accnt_no?>" name="accnt_no" class="form-control" placeholder="Account Number">
                                </div>
                                <div class = "col-md-2">
                                    <label>Office</label>
                                    <input required  value ="<?php echo  trim($accnt_name)?>" name="accnt_name" class="form-control" placeholder="Office">
                                </div>
                            </div>
                        </div>
                        <button  type="submit" name="submit" class="btn btn-success">Update Record</button>
                        <a type= "button" class="btn btn-danger" href = "adminAccounts.php"> Cancel</a>
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
