<?php require_once "dataProcessing.php";
if(strlen($_SESSION['ad_email']) == 0){
  header('location: index.php');
}else{
  $email = $_SESSION['ad_email'];
  $query = mysqli_query($con,"SELECT * FROM admin WHERE email = '$email'");
  $rw = mysqli_fetch_array($query);
}

if(isset($_GET['del'])){
	mysqli_query($con,"UPDATE users SET userStatus='Inactive' WHERE token = '".$_GET['userToken']."'");
    $_SESSION['delmsg']="user deleted !!";
}
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin&nbsp<?php echo htmlentities($rw['name']); ?> | Users</title>
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
      <h3>signed in as &nbsp<br><?php echo htmlentities($rw['name']); ?></h3>
      <div class="break">.</div>&emsp;
      <ul>
        <li class="list"><a href="dashboard.php" class="list-links">dashboard&nbsp<i class="fa fa-dashboard"></i></a></li>
        <li class="list"><a href="users.php" class="list-links">users&nbsp<i class="fa fa-user"></i></a></li>
        <li class="list"><a href="add-users.php" class="list-links"><i class="fa fa-plus"></i>&nbspadd users</a></li>
        <li class="list"><a href="users-log.php" class="list-links"><i class="fa fa-calendar"></i>&nbsp users log</a></li>
        <li class="list"><a href="logout-user.php" class="list-links">logout&nbsp<i class="fa fa-sign-out"></i></a></li>
      </ul>
    </nav>
<br><br><br>

  <table id="example" class="table table-striped table-bordered nowrap" style="width:95%">
        <thead>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>email</th>
                <th>status</th>
                <th>user status</th>
                <th>update Date</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
<?php
 $query=mysqli_query($con,"SELECT * FROM users");
 $cnt=1;
 while($row=mysqli_fetch_array($query)){
?>

          <tr>
            <td><?php echo htmlentities($cnt);?></td>
            <td><?php echo htmlentities($row['name']);?></td>
            <td><?php echo htmlentities($row['email']);?></td>
            <td> <?php echo htmlentities($row['status']);?></td>
            <td> <?php echo htmlentities($row['userStatus']);?></td>
            <td> <?php echo htmlentities($row['updateDate']);?></td>
            <td>
            <a href="edit-users.php?userToken=<?php echo $row['token']?>" ><i class="fa fa-plus"></i></a>
            <a href="users.php?userToken=<?php echo $row['token']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i></a>
            </td>
          </tr>
          <?php $cnt=$cnt+1; } ?>
        </tbody>
    </table>

    <!--DATATABLES SECTION JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
    <!--END DATATABLES SECTION JS-->

    <script>
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        responsive: true
    } );

    new $.fn.dataTable.FixedHeader( table );
} );
    </script>
  </body>
</html>
