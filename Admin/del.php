<?php
$db1 = mysqli_connect('localhost', 'root', '', 'dbms');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query1 = "SELECT * FROM collage WHERE Student_Id='$id'";
    $result1 = mysqli_query($db1, $query1);

    if ($result1 && mysqli_num_rows($result1) > 0) {
        // Fetch the complaint details
        $complaint = mysqli_fetch_assoc($result1);

        // Get the complaint date and type
        $complaintDate = $complaint['complaint_date'];
        $complaintType = $complaint['complaint_type'];

        // Delete the complaint record based on the complaint date and type
        $query2 = "DELETE FROM collage WHERE Student_Id='$id' AND complaint_date='$complaintDate' AND complaint_type='$complaintType'";
        $result2 = mysqli_query($db1, $query2);

        if ($result2) {
            echo "Record deleted successfully";
            header('location: campus_studentdetail.php');

            // Send email notification
            $to = $complaint['email'];
            $subject = "Complaint Status";
            $message = "Dear ".$complaint['Student_Id'].",\n\nYour complaint with ID ".$complaintType." has been resolved and deleted.\n\nBest regards,\nRGUKT SKLM";
            $headers = "From: brahmininavya@gmail.com";

            mail($to, $subject, $message, $headers);
        } else {
            echo "Error deleting record: " . mysqli_error($db1);
        }
    } else {
        echo "Complaint not found";
    }
}
mysqli_close($db1);
?>
