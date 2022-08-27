<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  if ($_SESSION['role'] == 'admin') {
    header("location: admin/index.php");
  } elseif ($_SESSION['role'] == 'teacher') {
    header("location: teacher/index.php");
  } elseif ($_SESSION['role'] == 'student') {
    header("location: student/index.php");
  } else {
    header("location: index.php");
  }
  exit;
}

require_once "connection.php";
$usernameErr = $passErr = $loginErr = $roleErr = "";
$username = $pass = $role = "";

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "Please enter your username";
    $_SESSION["error"] = $usernameErr;
    header("location: index/login.html");
    exit;
  } elseif (!preg_match("/^[a-zA-Z0-9_]*$/", $username)) {
    $usernameErr = "Invalid username format";
    $_SESSION["error"] = $usernameErr;
    header("location: index/login.html");
    exit;
  } else {
    $username = trim($_POST["username"]);
  }

  if (empty($_POST["psw"])) {
    $passErr = "Please enter your password";
    $_SESSION["error"] = $passErr;
    header("location: index/login.html");
    exit;
  } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", test_input($_POST["psw"]))) {
    $passErr = "Invalid password format";
    $_SESSION["error"] = $passErr;
    header("location: index/login.html");
    exit;
  } else {
    $pass = trim($_POST["psw"]);
  }

  if (isset($_POST['admin'])) {
    $role = 'admin';
  } elseif (isset($_POST['teacher'])) {
    $role = 'teacher';
  } elseif (isset($_POST['student'])) {
    $role = 'student';
  } else {
    $roleErr = "Role not exist";
    $_SESSION["error"] = $roleErr;
    header("location: index/login.html");
    exit;
  }

  if (empty($usernameErr) && empty($passErr) && empty($roleErr)) {
    if ($role == 'admin') {
      $sql = "SELECT * FROM admins WHERE username = ?";
    } else {
      $sql = "SELECT accountID, username, password, role FROM account WHERE username = ? AND role = ?";
    }
    if ($stmt = mysqli_prepare($conn, $sql)) {
      // Bind variables to the prepared statement as parameters
      if ($role != 'admin') {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_role);
        // Set parameters
        $param_username = $username;
        $param_role = $role;
      } else {
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;
      }
      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);
        // Check if username exists, if yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1) {
          // Bind result variables
          if ($role != 'admin') {
            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role);
          } else {
            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
          }
          if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($pass, $hashed_password)) {
              // Password is correct, so start a new session
              //session_start();
              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;
              $_SESSION["role"] = $role;
              if ($role == 'admin') {
?>
                <script language='javascript'>
                  // window.alert('Login successfully, welcome Admin');
                  window.location.href = 'admin/';
                </script>
              <?php
              } elseif ($role == 'teacher') { ?>
                <script language='javascript'>
                  // window.alert('Login successfully, welcome Teacher');
                  window.location.href = 'teacher/';
                </script>
              <?php } elseif ($role == "student") { ?>
                <script language='javascript'>
                  // window.alert('Login successfully, welcome Student');
                  window.location.href = 'student/';
                </script>
<?php }
            } else {
              // Password is not valid, display a generic error message
              $loginErr = "Wrong password. Please try again";
              $_SESSION["error"] = $loginErr;
              header("location: index/login.html");
              exit;
            }
          }
        } else {
          // Username doesn't exist, display a generic error message
          $loginErr = "This username doesn't exist. Please try again";
          $_SESSION["error"] = $loginErr;
          header("location: index/login.html");
          exit;
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
        // echo "<script language='javascript'>
        //     alert('Login failed.Please try again');
        //     document.location='index.php?page=login#id01';
        // </script>";
      }
      // Close statement
      mysqli_stmt_close($stmt);
    }
  } else {
    // echo "<script language='javascript'>
    //    alert('Login failed.Please try again');
    //    document.location='index.php?page=login#id01';
    // </script>";
    $_SESSION["error"] = "Login failed. Please try again";
    header("location: index/login.html");
    exit;
  }
  mysqli_close($conn);
}
?>