<?php
session_start();
require_once("../connection.php");
$usernameErr = $emailErr = $passErr = $confirm_password_err =  "";
$username = $email = $pass = $confirm_password = "";


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$username = test_input($_POST["username"]);
$email = test_input($_POST["email"]);
$pass = test_input($_POST["psw"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {
      $usernameErr = "Please enter your username";
      $_SESSION["error"] = $usernameErr;
      header("location: student-list.html");
      exit;
    }else {
      // check if username only contains letters and number 0->9 and uderscore
      if(!preg_match("/^[a-zA-Z0-9_]*$/",$username)) {
        $usernameErr = "Invalid username format";
        $_SESSION["error"] = $usernameErr;
        header("location: student-list.html");
        exit;
      }
    }

    $sql = "SELECT username FROM account WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0) 
    {
      $usernameErr = "Sorry the username already exists. Please try again";
      $_SESSION["error"] = $usernameErr;
      header("location: student-list.html");
      exit;
    }
  
    if (empty($_POST["email"])) {
      $emailErr = "Please enter your email";
      $_SESSION["error"] = $emailErr;
      header("location: student-list.html");
      exit;
    }else {
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = "Invalid email format";
        $_SESSION["error"] = $emailErr;
        header("location: student-list.html");
        exit;
      }
    }
   
    $sql = "SELECT email FROM account WHERE email = '$email'";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0) 
    {
      $emailErr = "Sorry the email already exists. Please try again";
      $_SESSION["error"] = $emailErr;
      header("location: student-list.html");
      exit;
    }
  
    // validate password
    if(empty($_POST["psw"])){
      $passErr = "Please enter your password";
      $_SESSION["error"] = $passErr;
      header("location: student-list.html");
      exit;
    }else{
      if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",$pass)){
        $passErr = "Invalid password format";
        $_SESSION["error"] = $passErr;
        header("location: student-list.html");
        exit;
      }
    }

     // validate confirm password
    if(empty($_POST["confirm_password"])){
        $confirm_password_err = "Please confirm password";  
        $passErr = "Invalid password format";
        $_SESSION["error"] = $confirm_password_err;
        header("location: student-list.html");
        exit;
    } else{
        $confirm_pass = trim($_POST["confirm_password"]);
    if(empty($passErr) && ($pass != $confirm_pass)){
      $confirm_password_err = "Password did not match";
      $_SESSION["error"] = $confirm_password_err;
      header("location: student-list.html");
      exit;
    }
  }

  $param_password = password_hash($confirm_password, PASSWORD_DEFAULT);
  if(empty($usernameErr) && empty($emailErr) && empty($passErr) && empty($confirm_password_err)){
    $sql = "INSERT INTO account (username,password,email,role) VALUES ('$username','$param_password','$email','student')";
    if(mysqli_query($conn, $sql))
    {
      $_SESSION["success"] = "Successfully create student account";
      header("location: student-list.html");
      exit;
    }else{
      $_SESSION["success"] = "Fail to create student account";
      header("location: student-list.html");
      exit;
    }
  }else{
    $_SESSION["success"] = "Fail to create student account";
    header("location: student-list.html");
    exit;
  }
  mysqli_close($conn);
}?>