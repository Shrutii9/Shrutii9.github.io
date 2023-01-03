<?php 
    $showAlert = false;
    $showError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'partials/_dbconnect.php';
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        //$exists=false;
        $existSql = "SELECT * FROM `users` WHERE username = '$username'";
        
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            //$exists = true;
            $showError = "Username Already exists.";
        }
        
        else{
            $exists = false;
        
            if(($password == $cpassword)){
            
                //$sql = "INSERT INTO `userlist` (`username`, `password`, `dt`) VALUES ('$username', '$password', current_timestamp())";
                $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$password', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result){
                    $showAlert = true;
                }
            } 
            else{
                $showError = "Passwords do not match";
            }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;1,600&family=Poppins&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <title>SignUP</title>

  <style>
    .navbar{
        font-family: 'Poppins', sans-serif;
        
    }
    .bg-dark {
        background-color: #012970!important;
    }
    .logo{
        margin-right: 20px;
        color: white;
        font-weight: bolder;
        letter-spacing: 1px;
    }
    .page-body{
        min-height: 100%;
    }
    .left{
        left: 0;
        background-color: #F2F2F2;
        display:inline-block;
        position: absolute;
        min-height: 100vh;
        float: left;
    }
    .right{
        right: 0;
        position: absolute;
        background-color: #bfcff2;
        display: inline-block;
    }
    a.nav-link{
        color: white;
        font-weight: bolder;
        letter-spacing: 1px;
    }
    .left-section{
        background-color: #F2F2F2;
        /*height: 100%;*/
        min-height: 100vh;
        position: absolute;
        display: inline-block;
    }
    .nav-item{
        padding-left: 2.5rem;
        padding-right:2.5rem;
    }
    .container{
        background-color: white;
        width: 400px;
        font-family: 'Poppins', sans-serif;
        border-radius: 0.50rem;
        padding: 3%;
        box-shadow: 0px 16px 26px -9px rgba(0,0,0,0.75);   
    }
    .Logo{
        width: 60px;
        margin-bottom: 0.5rem;
    }
    .signUp-msg{
        font-size: 2rem;
        font-weight: bolder;
        margin-bottom: 1rem;
    }
    .signUp-msg2{
        font-size: 1rem;
        font-weight: bold;
        color: grey;
        margin-bottom: 3rem;
    }

    .field-desc{
        font-size: 0.85rem;
        font-weight: bolder;
    }

    .form-text{
        font-size: 0.75rem;
        font-weight: bolder;
    }
    .form-control{
        border-radius: 3.25rem;
        border: 1.5px solid #ced4da;
        font-size: 0.8rem;
        font-weight: bolder;
    }
    .form-control input{
        color: light grey;
    }

    .btn-div{
        text-align: center;
    }

    .btn{
        padding: 7px;
        width: 100%;
        border-color: #4154F1;
        border-radius: 3rem;
        margin-top: 1rem;
        background-color: #4154F1;
        font-weight: bolder;
        margin-bottom: 12px;
    }

    .todolist-img{
        width: 80%;
        
    }
    .img-container{
        text-align: center;
        margin-top: 5rem;
        margin-bottom: 8rem;
    }
  </style>
</head>
<body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your account is now created and you can login
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div> ';
    }
    if($showError){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $showError.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div> ';
    }
    ?>
    <div style="width: 100%; overflow: hidden; " class="page-body">
        <div style="width: 700px; float: left;" class = "split left">  

    <div class="container my-4">
            <div class = "Logo">
                    <img src = "TickLogo.svg" alt = "Logo">
            
            </div>
            <div class = "signUp-display">
                <h1 class="signUp-msg">Sign Up</h1>
                <h5 class="signUp-msg2">Keep up the productivity!</h5>

            <form action="/loginsystem/signup.php" method="post">
        <div class="form-group">
            <label class = "field-desc" for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            
        </div>
        <div class="form-group">
            <label class = "field-desc" for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder ="*maximum 20 characters">
        </div>
        <div class="form-group">
            <label class = "field-desc" for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
            <small id="emailHelp" class="form-text text-muted">Make sure to type the same password!</small>
        </div>
        
        <div class ="btn-div">
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </div>
        </form>
        </div>
    </div>
    </div>
        <div class="split right" style="margin-left: 700px;">
            <div class="img-container">
            <img src = "5272.jpg" alt="" class="todolist-img">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>