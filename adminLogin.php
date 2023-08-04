<?php
require 'config.php';
if(isset($_POST["submit"])){
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    $result = mysqli_query($conn,"SELECT * FROM users WHERE user_name = '$user_name'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        if($password == $row["password"]){
            $_SESSION["login"] = true;
            $_SESSION["user_id"] = $row["user_id"];
            header("Location:adminDashboard.php");

        }
        else{
            echo
            "<script> alert('Wrong Password'); </script>";
        }


    }else{
        echo
        "<script> alert('Account not registered'); </script>";
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
        <title>Admin Login</title>

        <link href="css/styles.css" rel="stylesheet">
    </head>
    <body>
      <div class = "login-container">
        <div class = "login-inner">
            <div class = "login-header">
                <div class = "logo-placeholder">
                    <img class = "logo-img" src="assets/logo.png">
                </div>
                <div class = "logo-text">
                    General Services Transportation<br/> Reservation Application
                </div>
            </div>
            <form class = "login-form" method="POST">
                        <div class="form-group">
                            <label for = "inputEmail">Admin Username</label>
                            <input  name = "user_name" id = "user_name" class = "form-control" required = "required" autofocus = "autofocus" placeholder="Enter Login">
                        </div>
                        <div class="form-group">
                            <label for = "inputEmail">Password</label>
                            <input  type = "password" name = "password" id = "password" class = "form-control" required = "required" placeholder="Enter Password">
                        </div>
                        <input class="btn btn-success btn-block" type="submit" name="submit" value = "Login">
                    </form>
                    <div>
                        <p class ="small"><a href="adminRegister.php">Create a New Account</a></p></div>
                    </div>
                    
            </div>
        </div>
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
    </body>
</html>
