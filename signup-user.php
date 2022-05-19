<?php require_once "dataProcessing.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--jQUERY CDN SECTION-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="img/icons/logo.png">
    <link rel="stylesheet" href="css/style.css">

    <script>
    function checkName() {
      jQuery.ajax({
        url: "check/checkNameAvailability.php",
        data: 'name='+$("#name").val(),
        type: "POST",
        success:function(data){
          $("#nameAvailability").html(data);
        },
        error:function(){}
      });
    }

    //EMAIL function
    function checkEmail() {
      jQuery.ajax({
        url: "check/checkEmailAvailability.php",
        data: 'email='+$("#email").val(),
        type: "POST",
        success:function(data){
          $("#emailAvailability").html(data);
        },
        error:function(){}
      });
    }

    //PASSWORD function
    function checkPassword() {
      jQuery.ajax({
        url: "check/checkPasswordAvailability.php",
        data: 'password='+$("#password").val(),
        type: "POST",
        success:function(data){
          $("#passwordAvailability").html(data);
        },
        error:function(){}
      });
    }

    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="signup-user.php" method="POST" autocomplete="">
                    <h2 class="text-center">Signup Form</h2>
                    <p class="text-center">It's quick and easy.</p>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" id="name" onblur="checkName()" placeholder="Full Name" required value="<?php echo $name ?>">
                        <span class="error-section" id="nameAvailability"></span>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" id="email" name="email" onblur="checkEmail()" placeholder="Email Address" required value="<?php echo $email ?>">
                        <span class="error-section" id="emailAvailability"></span>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" id="password" name="password" onblur="checkPassword()" placeholder="Password" required>
                        <span class="error-section" id="passwordAvailability"></span>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" id="btn" name="signup" value="Signup">
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="index.php">Login here</a></div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
