<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit();
}
$showAlert = false;
$username1=$_SESSION['username'];
if(isset($_POST['submit'])){
    include 'partials/_dbconnect.php';
    $task = $_POST["task"];
    $sql = "INSERT INTO `todo` (`task`, `user1`) VALUES ('$task', '$username1')";
    $result = mysqli_query($conn, $sql);
    if ($result){
      $showAlert = true;
    }
 
} 
else{
  $showError = "ERROR";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;1,600&family=Poppins&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Welcome - <?php echo $_SESSION['username']?></title>
</head>
<body>
    <?php require 'partials/_nav.php' ?>
    
    <div class="welcome-msg">
    <h1>Hi, <span class="user-name"><?php echo $_SESSION['username']?></span>.</h1>
    <h2>What are your goals for today?</h2>
    </div>
    <style>

      *{
        margin: 0;
        padding: 0;
      }
      body{
        font-family: 'Poppins', sans-serif;
      }

      /*nav bar */
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
      .nav-item{
        padding-left: 2.5rem;
        padding-right:2.5rem;
      }

      a.nav-link{
          color: white;
          font-weight: bolder;
          letter-spacing: 1px;
      }


      h1,h2{
        font-size: 27px;
      }
      
      .text-center{
        font-size: 27px;
        font-weight: bolder;
      }
      .welcome-msg{
        padding-top: 1.5rem;
        padding-left: 1.5rem;
        text-align: center;
        padding-bottom: 0.5rem;
      }
      .user-name{
        font-weight: bolder;
        letter-spacing: 1.5px;
      }

      .task-submit{
        display: flex;
        flex-direction: column;
      }
      #form-container{
        justify-content: center;
        display: flex;
        flex-direction: row;
        padding: 1% 0;
      }

      .form-btn{
        width: 60%;
      }
      
      .form-control{

        display: inline-block;
        width: 100%;
        border-radius: 3.25rem;
        border: 1.5px solid #ced4da;
        font-size: 0.8rem;
        font-weight: bolder;
      }

      .btn{
        padding: 4px;
        width: 6rem;
        border-color: #4154F1;
        border-radius: 3rem;
        background-color: #4154F1;
        font-weight: bolder;
      }
      
      .form-group{
        padding: 0 2%;
      }

      .container{
        background-color: #dfd1fd;
        padding: 1%;
        border-radius: 10px;
        -webkit-box-shadow: -1px 0px 42px -10px rgba(94,94,94,1);
-moz-box-shadow: -1px 0px 42px -10px rgba(94,94,94,1);
box-shadow: -1px 0px 42px -10px rgba(94,94,94,1);

      }

      .container,.table{
        color: #212529;
      }

      .fa{
        color: #c5130d;
      }
      
      
    </style>
    <div class="container my-4">

      <div class="task-submit">
        <div class="enterTask">
          <h1 class="text-center" id="enter-task">Create New Tasks: </h1>
        </div>
        <div id="form-btn">
          <form action="/loginsystem/welcome.php" method="post" id="form-container">
            <div class="form-group">
                
                <input type="text" class="form-control" id="task" name="task" aria-describedby="emailHelp">
                
            </div>
            <div class = "btn-div">
            <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    
        

    <div class="main-div">
      <div class="center-div">
<div class ="table responsive">
    <table class="table table-striped">
      <thead>
        <tr>
        <th>STATUS</th>
        <th>TASK</th>
        <th>DELETE</th>
      </tr>
      </thead>

      <tbody>
      <?php 
    include 'partials/_dbconnect.php';
    $username1=$_SESSION['username'];
    $sql = "SELECT task, user1 FROM todo WHERE user1= '{$username1}'";

    $result = $conn->query($sql);
    if($result->num_rows > 0) 
    {
      while($row = $result->fetch_assoc()) 
      {
        ?>
    
        <tr>
        <td><div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
<label class="form-check-label" for="flexCheckDefault"></label>
</div></td>
        <td><?php echo $row['task'];?></td>
        <td><a href="delete.php?task=<?php echo $row['task']; ?>" data-toggle="tooltip" data-placement="bottom" title="DELETE"> <i class="fa fa-trash" aria-hidden="true"></i> </a></td>
</tr>
        
      <?php
      }
    } 
    $conn->close();

    
    ?> 
    </tbody>
    </table>

  </div>
  </div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>