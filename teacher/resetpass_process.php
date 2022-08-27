<?php
// Initialize the session
// session_start();
require_once('./authen_teacher.php');
// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: ../index.php");
  exit;
}

// Include config file
require_once "../connection.php";

// Define variables and initialize with empty values
$oldpass = $pass = $confirm_password = "";
$oldErr = $passErr = $confirm_password_err = "";
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$oldpass = test_input($_POST['oldPass']);
$pass = test_input($_POST["psw"]);
$confirm_password = test_input($_POST["confirm_password"]);

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // validate new password
  if (empty($_POST["oldPass"])) {
    $oldErr = "Please enter your old password";
    $_SESSION["error"] = $oldErr;
    header("location: reset-password.html");
    exit;
  } else {
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $oldpass)) {
      $passErr = "Invalid old password format";
      $_SESSION["error"] = $oldErr;
      header("location: reset-password.html");
      exit;
    }
  }

  // validate new password
  if (empty($_POST["psw"])) {
    $passErr = "Please enter your new password";
    $_SESSION["error"] = $passErr;
    header("location: reset-password.html");
    exit;
  } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $pass)) {
    $passErr = "Invalid new password format";
    $_SESSION["error"] = $passErr;
    header("location: reset-password.html");
    exit;
  } else {
    if (empty($oldErr) && ($oldpass == $pass)) {
      $passErr = "New password must not be old password";
      $_SESSION["error"] = $passErr;
      header("location: reset-password.html");
      exit;
    }
  }

  // validate confirm password
  if (empty($_POST["confirm_password"])) {
    $confirm_password_err = "Please confirm your new password";
    $_SESSION["error"] = $confirm_password_err;
    header("location: reset-password.html");
    exit;
  } else {
    $confirm_pass = trim($_POST["confirm_password"]);
    if (empty($passErr) && ($pass != $confirm_pass)) {
      $confirm_password_err = "Password did not match";
      $_SESSION["error"] = $confirm_password_err;
      header("location: reset-password.html");
      exit;
    }
  }

  // Check input errors before updating the database
  if (empty($oldErr) && empty($passErr) && empty($confirm_password_err)) {
    // Prepare an update statement
    $sql = "UPDATE users SET password = ? WHERE userID = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

      // Set parameters
      $param_password = password_hash($pass, PASSWORD_DEFAULT);
      $param_id = $_SESSION["id"];

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Password updated successfully. Destroy the session, and redirect to login page
        echo "<script language='javascript'>
                        alert('Update password successfully. Please login again');
                        window.location='../index/login.html';
                     </script>";
        // $_SESSION["success"] = "Update new password successfully";
        // header("location: index.php?page=reset#id05");
        // exit();
        session_destroy();
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($conn);
}
