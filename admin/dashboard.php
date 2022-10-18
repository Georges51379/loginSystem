<?php session_start();
require "db/connection.php";

if(strlen($_SESSION['ad_email']) == 0 ){
  header('location: index.php');
}
else{
$email = $_SESSION['ad_email'];
$query = mysqli_query($con,"SELECT * FROM admin WHERE email = '$email'");
$rows = mysqli_fetch_array($query);
}
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="img/icons/logo.png">
    <link rel="stylesheet" href="css/dashboard.css">
  </head>

  <body>
    <nav>
      <h1>login system&emsp;</h1>
      <h3>signed in as &nbsp<br><?php echo $rows['name']; ?></h3>
      <div class="break">.</div>&emsp;
      <ul>
        <li class="list"><a href="dashboard.php" class="list-links">dashboard&nbsp<i class="fa fa-dashboard"></i></a></li>
        <li class="list"><a href="users.php" class="list-links">users&nbsp<i class="fa fa-user"></i></a></li>
        <li class="list"><a href="logout-user.php" class="list-links">logout&nbsp<i class="fa fa-sign-out"></i></a></li>
      </ul>
    </nav>

<center>
  <div class="tables">
<?php
$query = mysqli_query($con,"SELECT * FROM users");
$rw = mysqli_num_rows($query);
$numbUsers = $rw;
?>
    <table class="dashboard-table">
      <thead>
        <tr>
          <td>number of users</td>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><?php echo $numbUsers; ?></td>
        </tr>
      </tbody>
    </table>
<?php
$query = mysqli_query($con,"SELECT * FROM users Where userStatus = 'Inactive'");
$row = mysqli_num_rows($query);
$inactiveUsers = $row;
?>
    <table class="dashboard-table">
      <thead>
        <tr>
          <td>number of inactive users</td>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><?php echo $inactiveUsers; ?></td>
        </tr>
      </tbody>
    </table>
<?php
$query = mysqli_query($con,"SELECT * FROM users Where userStatus = 'Active'");
$row = mysqli_num_rows($query);
$activeUsers = $row;
 ?>
    <table class="dashboard-table">
      <thead>
        <tr>
          <td>number of active users</td>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><?php echo $activeUsers; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</center>
  </body>
</html>
