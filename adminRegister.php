<?php
require 'config.php';
if(isset($_POST["submit"])){
    $u_fname = $_POST["u_fname"];
    $u_lname = $_POST["u_lname"];
    $u_email = $_POST["u_email"];
    $u_pwd = $_POST["u_pwd"];
    $u_phone = $_POST["u_phone"];
    $u_addr = $_POST["u_addr"];
    $duplicate = mysqli_query($conn, "SELECT * FROM tms_user WHERE  u_email = '$u_email'");
    if(mysqli_num_rows($duplicate)> 0){
        echo
        "<script> alert('Username or Email is already taken.'); </script>";
    }else{
        $query = "INSERT INTO tms_user VALUES('', '$u_fname','$u_lname','$u_phone','$u_addr','','$u_email','$u_pwd','','','','')";
        mysqli_query($conn,$query);
        echo
        "<script> alert('Your account has been registered'); </script>";
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
        <title>Admin Register</title>

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
                        <div class = "form-group">
                            <div class = "form-row">
                                <div class = "col-md-2">
                                    <input  name = "u_fname" id = "u_fname" class = "form-control" required = "required" autofocus = "autofocus" placeholder="First Name">
                                </div>
                                <div class = "col-md-2">
                                    <input  name = "u_lname" id = "u_lname" class = "form-control" required = "required" autofocus = "autofocus" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <div class = "form-group">
                            <div class=""form-field-component>
                                <input name = "u_phone" id = "u_phone" class = "form-control" required = "required" autofocus = "autofocus" placeholder="Contact No.">
                            </div>
                        </div>
                        <div class = "form-group">
                            <div class="form-field-component">
                                <input  name = "u_addr" id = "u_addr" class = "form-control" required = "required" autofocus = "autofocus" placeholder="Home Address">
                            </div>
                        </div>
                        <div class = "form-group">
                            <div class="form-field-component">
                                <input type = "email" name = "u_email" id = "u_email" class = "form-control" required = "required" autofocus = "autofocus" placeholder="Enter Login">
                            </div>
                        </div>
                        <div class = "form-group">
                            <div class="form-field-component">
                                <input  type = "password" name = "u_pwd" id = "u_pwd" class = "form-control" required = "required" autofocus = "autofocus" placeholder="Enter Password">
                            </div>
                        </div>
                        <button class="btn btn-success btn-block" type="submit" name="submit">Register</button>
                    </form>
                    <div>
                        <p class ="small"><a href="adminLogin.php">Return to Login Page</a></p></div>
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
