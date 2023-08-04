<?php
include 'config.php';
if(isset($_GET['acc_delete_id'])){
    $id = $_GET['acc_delete_id'];
    $sql = "DELETE FROM accounts WHERE accnt_id = $id";
    $result = mysqli_query($conn,$sql);

    if($result){
        header('location:adminAccounts.php');
    }else{
        die(mysqli_error($conn));
    }
}
?>

<?php
include 'config.php';
if(isset($_GET['d_delete_id'])){
    $id = $_GET['d_delete_id'];
    $sql = "DELETE FROM drivers WHERE d_id = $id";
    $result = mysqli_query($conn,$sql);

    if($result){
        header('location:adminDrivers.php');
    }else{
        die(mysqli_error($conn));
    }
}
?>

<?php
include 'config.php';
if(isset($_GET['r_delete_id'])){
    $id = $_GET['r_delete_id'];
    $sql = "DELETE FROM rates WHERE rate_id = $id";
    $result = mysqli_query($conn,$sql);

    if($result){
        header('location:adminRates.php');
    }else{
        die(mysqli_error($conn));
    }
}
?>

<?php
include 'config.php';
if(isset($_GET['v_delete_id'])){
    $id = $_GET['v_delete_id'];
    $sql = "DELETE FROM vehicles WHERE v_id = $id";
    $result = mysqli_query($conn,$sql);

    if($result){
        header('location:adminVehicles.php');
    }else{
        die(mysqli_error($conn));
    }
}
?>