<?php
session_start();
include('db/connection.php');
error_reporting(0);

if(strlen($_SESSION['email']) == 0 ){
  header('location: index.php');
}else{
  $email = $_SESSION['email'];
  $query = mysqli_query($con,"SELECT * FROM admin WHERE email = '$email'");
  $rw = mysqli_fetch_array($query);

  date_default_timezone_set('Asia/Beirut');// change according timezone
  $currentTime = date( 'd-m-Y h:i:s A', time () );
  $id=intval($_GET['id']);// USERS id

  if(isset($_POST['edit'])){
    $name =$_POST['name'];
    $email =$_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['status'];
    $userStatus = $_POST['userStatus'];

    $updateQuery = mysqli_query($con,"UPDATE user$ SET name='$name', email='$email', password='$password', status='$status',
       userStatus='$userStatus', updateDate='$currentTime' WHERE id='$id'");
       header('location:users.php');
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
<?php
$query = mysqli_query($con,"SELECT * FROM user$ where id = '$id'");
$cnt = 1;
while($rws = mysqli_fetch_array($query)){ ?>
    <center>
      <form method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="" class="form-label">user name</label>
          <input type="text" name="name" class="form-control" placeholder="enter user name" value="<?php echo htmlentities($rws['name']); ?>">
        </div>

        <div class="form-group">
          <label for="" class="form-label">user email</label>
          <input type="email" name="email" class="form-control" placeholder="enter user email" value="<?php echo htmlentities($rws['email']); ?>">
        </div>

        <div class="form-group">
          <label for="" class="form-label">user password</label>
          <input type="password" name="password" class="form-control" placeholder="enter user password" value="<?php echo htmlentities($rws['password']); ?>">
        </div>

        <div class="form-group">
          <label for="" class="form-label">user status code</label>
          <input type="text" name="status" class="form-control" placeholder="enter user status" value="<?php echo htmlentities($rws['status']); ?>">
        </div>

        <div class="form-group">
          <label for="" class="form-label">user deactivation status</label>
          <input type="number" name="userStatus" class="form-control" placeholder="enter user deactivation" value="<?php echo htmlentities($rws['userStatus']); ?>">
        </div>

        <button type="submit" name="edit" class="btn btn-primary">Submit</button>

      </form>
    </center>
<?php } ?>
    </body>
</html>
