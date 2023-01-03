<?php 
    $login = false;
    $showError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'partials/_dbconnect.php';
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        
            $sql = "Select * from users where username ='$username' AND password='$password'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 1){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: welcome.php");
            }
        
        else{
            $showError = "Invalid Credentials";
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
  <title>Login</title>
  <style>
    .navbar{
        font-family: 'Poppins', sans-serif;
        background-color: #273274;
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
    .left{
        left: 0;
        background-color: #F2F2F2;
        display:inline-block;
        position: absolute;
        min-height: 100vh;
    }
    .right{
        position: relative;
        background-color: #bfcff2;
        display: inline-block;
        min-height: 100vh;
    }
    .container{

        background-color: white;
        width: 400px;
        font-family: 'Poppins', sans-serif;
        font-weight: bolder;
        border-radius: 0.50rem;
        padding: 3%;
        box-shadow: 0px 16px 26px -9px rgba(0,0,0,0.75);
    }
    .container.my-4{
        margin-top: 4rem;
    }
    .nav-item{
        padding-left: 2.5rem;
        padding-right:2.5rem;
    }

    a.nav-link{
        color: white;
        font-weight: bolder;
        letter-spacing: 1px;
    }
    .Login-display{
        
    }
    .Login-msg{
        font-size: 2rem;
        font-weight: bolder;
        margin-bottom: 1rem;
    }
    .Login-msg2{
        font-size: 1rem;
        font-weight: bold;
        color: grey;
        margin-bottom: 3rem;
    }
    .field-desc{
        font-size: 0.85rem;
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
    .Logo{
        width: 60px;
        margin-bottom: 0.5rem;
    }
    .link-sign{
        color: light grey;
    }
    .not-registered{
        font-size: 0.8rem;
    }
    
    .todolist-img{
        width:70%;
    
    }
    .img-container{
        text-align: center;
        margin: 5rem 0 4rem 0;
    }
  </style>
</head>
<body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($login){
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You are logged in
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

    <div style="width: 100%; overflow: hidden;height: 100vh">

        <!--left section-->
        
        <div style="width: 700px;float: left;" class = "split left">  
        <div class="container my-4">
                <div class = "Logo">
                    <img src = "TickLogo.svg" alt = "Logo">
                </div>
                <div class = "Login-display">
                <h1 class="Login-msg">Login</h1>
                <h5 class= "Login-msg2">Keep up the productivity!</h2>
                <form action="/loginsystem/Login.php" method="post">
                    <div class="form-group">
                        <label class = "field-desc" for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                        
                    </div>
                    <div class="form-group">
                        <label class = "field-desc" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" >
                    </div>
                    <div class = "btn-div">
                    <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <div class="not-registered">
                        <p>Not registered yet? <a href = "/loginsystem/signup.php" class = "link-sign">Sign Up here.</a></p>
                    </div>
                </form>
                </div>
        </div>
        </div>

        <!--Right section-->
        <div class = "split right" style="margin-left: 700px;"> 

        <div class="img-container">
            <img src="3411092.jpg" alt="" class="todolist-img">
        </div>
            
        </div>
    </div>
    </div>
        
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>