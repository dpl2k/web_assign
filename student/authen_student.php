<?php
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['role'] !== 'student') {
    header("location: ../index.html");
    exit;
}
