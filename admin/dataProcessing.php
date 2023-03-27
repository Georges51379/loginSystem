<?php
session_start();
require "db/connection.php";
$email = "";
$name = "";
$errors = array();
//CHECK CODE VERIFICATION SECTION (USER-OTP.PHP)
  if(isset($_POST['check-code'])){
    $_SESSION['info'] = "";
    $otp_code = $_POST['otp'];
    $query_check_code = mysqli_query($con, "SELECT * FROM admin WHERE emailCode = '$otp_code'");
    $rows = mysqli_num_rows($query_check_code);
    if($rows > 0 ){
      $rw = mysqli_fetch_array($query_check_code);
      $fetch_code = $rw['emailCode'];
      $email = $rw['email'];
      $code = 0;
      $status = 'verified';
      $updated_check_code_query = mysqli_query($con, "UPDATE admin SET emailCode = '$code', adminVerified = '$status' WHERE emailCode = '$fetch_code'");
      if($updated_check_code_query){
        $_SESSION['name'] = $name;
        $_SESSION['ad_email'] = $email;
        header('location: dashboard.php');
        exit();
      }else{
          $errors['otp-error'] = "Failed while updating code!";
      }
  }else{
      $errors['otp-error'] = "You've entered incorrect code!";
  }
}
//LOGIN CHECK (INDEX.PHP)
  if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = mysqli_query($con, "SELECT * FROM admin WHERE email = '$email' AND adminStatus = 'Active'");
    $row = mysqli_num_rows($query);
    if($row > 0){
      $rw = mysqli_fetch_array($query);
      $fetched_pwd = $rw['password'];
      if(password_verify($password, $fetched_pwd)){
          $_SESSION['ad_email'] = $email;
          $status = $rw['adminVerified'];
          if($status == 'verified'){
            $_SESSION['ad_email'] = $email;
            $_SESSION['password'] = $password;
              header('location: dashboard.php');
            }else{
                $info = "It looks like you haven't verified your email - $email";
                $_SESSION['info'] = $info;
                header('location: user-otp.php');
            }
        }else{
            $errors['email'] = "Incorrect email or password!";
        }
        }else{
        $errors['email'] = "It looks like you're not a member! Click on the bottom link to signup.";
        }
}
//FORGOTPWD (FORGOTPWD.PHP)
if(isset($_POST['forgotpwd'])){
  $email = $_POST['email'];
  $query = mysqli_query($con, "SELECT * FROM admin WHERE email = '$email'");
  $rows = mysqli_num_rows($query);
  if($rows > 0){
    $code = rand(99999999, 11111111);
    $update_code_query = mysqli_query($con, "UPDATE admin SET emailCode = '$code' WHERE email = '$email'");
    if($update_code_query){
      $subject = "Password Reset Code";
      $message = "Your password reset code is $code";
      $sender = "From: boutros.georges513@gmail.com.com";
      if(mail($email, $subject, $message, $sender)){
          $info = "We've sent a passwrod reset otp to your email - $email";
          $_SESSION['info'] = $info;
          $_SESSION['ad_email'] = $email;
          header('location: reset-code.php');
          exit();
        }else{
            $errors['otp-error'] = "Failed while sending code!";
        }
    }else{
        $errors['db-error'] = "Something went wrong!";
    }
    }else{
    $errors['email'] = "This email address does not exist!";
  }
}
//RESET CODE SECTIO (RESET-CODE.PHP)
if(isset($_POST['check-reset-otp'])){
  $_SESSION['info'] = "";
  $otp_code = $_POST['otp'];
  $query = mysqli_query($con, "SELECT * FROM admin WHERE emailCode = '$otp_code'");
  $rows = mysqli_num_rows($query);
  if($rows > 0){
    $rw = mysqli_fetch_array($query);
    $email = $rw['email'];
    $_SESSION['ad_email'] = $email;
    $info = "Please enter a password that you do not use on any other accounts";
    $_SESSION['info'] = $info;
    header('location: new-password.php');
    exit();
  }else{
    $errors['otp-error'] = "You've entered incorrect code!";
  }
}
//NEW PASSWORD SECTION (NEW-PASSWORD.PHP)
if(isset($_POST['change-password'])){
  $_session['info'] = "";
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  if($password !== $cpassword){
    $errors['password'] = "Password do no match!!!";
  }else{
      $code = 0;
      $email = $_SESSION['email']; //getting this email using session
      $hashedpwd = password_hash($password, PASSWORD_BCRYPT);
      $update_query = mysqli_query($con, "UPDATE admin SET emailCode = '$code', password = '$hashedpwd' WHERE email = '$email'");
      if($update_query){
        $info = "Password Changed! You can now login using your new Password";
        $_SESSION['info'] = $info;
        header('location: password-changed.php');
      }else{
        $errors['db-error'] = "Failed to change your password!";
      }
  }
}
//PASSWORDCHANGED SECTION (PASSWORD-cHANGED.PHP)
 if(isset($_POST['login-now'])){
     header('Location: dashboard.php');
 }
?>
