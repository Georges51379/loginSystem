<?php
session_start();
include('db/connection.php');
error_reporting(0);

if(strlen($_SESSION['ad_email']) == 0 ){
  header('location: index.php');
}else{
  $email = $_SESSION['ad_email'];
  $query = mysqli_query($con,"SELECT * FROM admin WHERE email = '$email'");
  $rw = mysqli_fetch_array($query);

  $id=intval($_GET['id']);// USERS id

  if(isset($_POST['add'])){

    $name =$_POST['name'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $status =$_POST['status'];
    $userStatus =$_POST['userStatus'];
    $hashedpwd = password_hash($password, PASSWORD_BCRYPT);
    $hashedToken = random_bytes(20);
    $_SESSION['token'] = bin2hex($hashedToken);

    $insertQuery = mysqli_query($con,"INSERT INTO users (token, name, email, password, code , status, userStatus)
                    VALUES ('".$_SESSION['token']."' ,'$name', '$email', '$hashedpwd', '0', '$status', '$userStatus')");
      header('location: users.php');
  }
}
?>
<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin&nbsp<?php echo $rw['name']; ?> | Edit Users</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
      <link href="https://cdn.datatables.net/fixedheader/3.2.1/css/fixedHeader.bootstrap.min.css">
      <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap.min.css">
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="shortcut icon" href="img/icons/logo.png">
      <link rel="stylesheet" href="css/dashboard.css">
    </head>

    <body>
      <nav>
        <h1>login system&emsp;</h1>
        <h3>signed in as &nbsp<br><?php echo $rw['name']; ?></h3>
        <div class="break">.</div>&emsp;
        <ul>
          <li class="list"><a href="dashboard.php" class="list-links">dashboard&nbsp<i class="fa fa-dashboard"></i></a></li>
          <li class="list"><a href="users.php" class="list-links">users&nbsp<i class="fa fa-user"></i></a></li>
          <li class="list"><a href="logout-user.php" class="list-links">logout&nbsp<i class="fa fa-sign-out"></i></a></li>
        </ul>
      </nav>
  <br><br><br>

    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="" class="form-label">user name</label>
        <input type="text" class="form-control" name="name" placeholder="enter user name">
      </div>

      <div class="form-group">
        <label for="" class="form-label">email</label>
        <input type="email" class="form-control" name="email" placeholder="enter user email">
      </div>

      <div class="form-group">
        <label for="" class="form-label">password</label>
        <input type="password" class="form-control" name="password" placeholder="enter user password">
      </div>

      <div class="form-group">
        <label for="" class="form-label">status</label>
        <input type="text" class="form-control" name="status" placeholder="enter user code status">
      </div>

      <div class="form-group">
        <label for="" class="form-label">user Status</label>
        <select type="text" name="userStatus" class="adminform_input" required>
          <option value="--Select An Option--">-Select An Option--</option>
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>

      <button type="submit" name="add" class="btn btn-primary">add</button>

    </form>

  </body>
</html>
