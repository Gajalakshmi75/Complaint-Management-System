<?php
session_start();

// variable declaration
$Student_Id = "";
$roomno = "";
$errors = array();
$_SESSION['success'] = "";

// connect to database
$db1 = mysqli_connect('localhost', 'root', '', 'dbms');

// REGISTER USER
if (isset($_POST['sub_user'])) {
    // receive all input values from the form
    $complaint_date = mysqli_real_escape_string($db1, $_POST['complaint_date']);
    $Student_Id = mysqli_real_escape_string($db1, $_POST['Student_Id']);
    $phoneno = mysqli_real_escape_string($db1, $_POST['phoneno']);
    $email = mysqli_real_escape_string($db1, $_POST['email']);
    $block_name = mysqli_real_escape_string($db1, $_POST['block_name']);
    $floor = mysqli_real_escape_string($db1, $_POST['floor']);
    $roomno = mysqli_real_escape_string($db1, $_POST['roomno']);
    $complaint_type = mysqli_real_escape_string($db1, $_POST['complaint_type']);
    $importance = mysqli_real_escape_string($db1, $_POST['importance']);
    $description = mysqli_real_escape_string($db1, $_POST['description']);

    // form validation: ensure that the form is correctly filled
    if (empty($Student_Id)) {
        array_push($errors, "Student_Id is required");
    }
    if (empty($complaint_type)) {
        array_push($errors, "complaint_type is required");
    }
    if (empty($roomno)) {
        array_push($errors, "Email is required");
    }
    if (empty($complaint_date)) {
        array_push($errors, "date is required");
    }

	

    // register user if there are no errors in the form
    if (count($errors) == 0) {
        $query1 = "INSERT INTO complaints (complaint_date, Student_Id, phoneno, email, block_name, floor, roomno, complaint_type, importance, description) 
                  VALUES ('$complaint_date', '$Student_Id', '$phoneno', '$email', '$block_name', '$floor', '$roomno', '$complaint_type', '$importance', '$description')";
        $results1 = mysqli_query($db1, $query1);
        $query2 = "INSERT INTO backup_complaints (complaint_date, Student_Id, phoneno, email, block_name, floor, roomno, complaint_type, importance, description) 
                  VALUES ('$complaint_date', '$Student_Id', '$phoneno', '$email', '$block_name', '$floor', '$roomno', '$complaint_type', '$importance', '$description')";
        $results1 = mysqli_query($db1, $query2);

        if ($results1) {
            $_SESSION['success'] = "Your complaint is registered";
            header('location: problem.php');
            exit(); // Terminate the script after redirection
        } else {
            array_push($errors, "Wrong input");
        }
    } else {
        array_push($errors, "Wrong input1");
    }
}

if (isset($_POST['subuser'])) {
    $Student_Id = $_POST['Student_Id'];
    $block_name = $_POST['block_name'];
    $floor = $_POST['floor'];
    $roomno = $_POST['roomno'];
    $complaint_type = $_POST['complaint_type'];
    $rate = $_POST['rate'];
    $description = $_POST['description'];

    if (count($errors) == 0) {
        // Escape the values to prevent SQL injection
        $escaped_Student_Id = mysqli_real_escape_string($db1, $Student_Id);
        $escaped_block_name = mysqli_real_escape_string($db1, $block_name);
        $escaped_floor = mysqli_real_escape_string($db1, $floor);
        $escaped_roomno = mysqli_real_escape_string($db1, $roomno);
        $escaped_complaint_type = mysqli_real_escape_string($db1, $complaint_type);
        $escaped_rate = mysqli_real_escape_string($db1, $rate);
        $escaped_description = mysqli_real_escape_string($db1, $description);

        $query4 = "INSERT INTO feedback (Student_Id, block_name, floor, roomno, complaint_type, rate, description) 
                  VALUES ('$Student_Id', '$escaped_block_name', '$escaped_floor', '$escaped_roomno', '$escaped_complaint_type', '$escaped_rate', '$escaped_description')";

        $results1 = mysqli_query($db1, $query4);

        if ($results1) {
            $_SESSION['success'] = "Your feedback is registered";
            header('location: student_manage.php');
            exit();
        } else {
            array_push($errors, "Wrong input");
        }
    }
}
?>