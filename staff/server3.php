<?php
session_start();

// variable declaration
$username = "";
$password = "";
$errors = array();
$_SESSION['success'] = "";

// connect to database
$db1 = mysqli_connect('localhost', 'root', '', 'dbms');

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db1, $_POST['username']);
    $password = mysqli_real_escape_string($db1, $_POST['password']);

    // Form validation
    if (empty($username)) {
        array_push($errors, "staff ID is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // Proceed with login if no errors
    if (count($errors) == 0) {
        $query = "SELECT * FROM staff WHERE staffname='$username' AND password='$password'";
        $results = mysqli_query($db1, $query);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['staffname'] = $username;
			$_SESSION['success'] = "You are now logged in";
            header('location: staff_manage.php');
        } else {
            array_push($errors, "Wrong admin ID/password combination");
        }
    }
}
?>
