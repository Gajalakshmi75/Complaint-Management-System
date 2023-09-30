<?php
// Connect to the database
$db1 = mysqli_connect('localhost', 'root', '', 'dbms');

// Check the connection
if (!$db1) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve the total number of users
$query = "SELECT COUNT(*) AS total_users FROM registration";
$query1 = "SELECT COUNT(*) AS total_complaints FROM complaints";
$query2 = "SELECT COUNT(*) AS total_backups FROM backup_complaints";

// Execute the queries
$result = mysqli_query($db1, $query);
$result1 = mysqli_query($db1, $query1);
$result2 = mysqli_query($db1, $query2);

// Check if the queries were successful
if ($result && $result1 && $result2) {
    // Fetch the results as associative arrays
    $row = mysqli_fetch_assoc($result);
    $row1 = mysqli_fetch_assoc($result1);
    $row2 = mysqli_fetch_assoc($result2);

    // Access the total_users, total_complaints, and total_backups values from the associative arrays
    $totalUsers = $row['total_users'];
    $totalComplaints = $row1['total_complaints'];
    $totalBackups = $row2['total_backups'];

    // Calculate the count of solved complaints
    $solvedComplaints = $totalComplaints - $totalBackups;
    
    // Ensure solved complaints is never negative
    $solvedComplaints = max(0, $solvedComplaints);
} else {
    // Handle query errors
    $totalUsers = 0;
    $totalComplaints = 0;
    $totalBackups = 0;
    $solvedComplaints = 0;
}

// Close the database connection
mysqli_close($db1);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
  border-radius: 50%;
  align-items: center;
  border-radius: .8rem;
  color: black;
  text-align: center;
  background-color: whitesmoke;
}
.admin{
  font-weight: 900;
  font-size: 60px;
  color:#FF6EC7;
  padding-right: 90px;
  margin-bottom:  40px;
  font-family:"monotype corsiva" ;
  text-align: center;
}
.dashboard{
  padding: 20px;
  background-color:#000080;
  color: white;
  font-size: 2rem;
  font-weight: 800;
  font-family: 'monotype corsiva';
  border-bottom: 3px solid pink;
}
.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #000080;
  position: fixed;
  height: 100%;
  overflow: auto;
  border: black;
  box-shadow: 0 10px 20px 0px black;
  border-radius:0 20px 20px 0px;
  transition: .5rem;
  font-family: Georgia, 'Times New Roman', Times, serif;
  color: whitesmoke;

}

.sidebar a {
  display: block;
  color:white;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #800020;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #FF6EC7;
  color: black;
  border: black;
  margin-top: 10px;
  transition: 1rem;
}
.container{
			/*width:1000px;
			height:500px;
			border:1px solid red;*/
			padding-left: 350px;
			margin:0 auto;
			background-color: whitesmoke;
			font-family: 'cursive;';

		}
		.col{
			width:200px;
			height:110px;
			background-color:#000080;
			float: left;
			padding:40px;
			margin:20px;
			border-radius: 15px;
			color:white;
			transition: o.9s;
			box-shadow: 1px 2px 3px 4px rgba(0, 0, 0, 0.2),0 6px 20px 0 rgba(0, 0, 0, 0.19);
			/* box-shadow: 1px 2px 3px 3px rgba(20, 20, 20, 0.4);*/
		}
		.col:hover{
			cursor: pointer;
			background-color: #1357BE;
			color:black;
            letter-spacing: 4px;
		}


@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
</style>
</head>
<body>

<div class="sidebar">
  <div class="dashboard">DashBoard</div>
  <a href="#home">Home</a>
  <a href="register2.php">Staff Registration</a>
  <a href="admin_studentdetail.php">Hostel Complaint Details</a>
  <a href="campus_studentdetail.php">campus Complaint Details</a>
  <a href="faculty_details.php">faculty Complaint Details</a>
  <a href="staff.php">staff details</a>
  <a href="total_complaints.php">total complaints</a>
  <a href="feedback.php">Feedback</a>
</div>
<div class="container">
  <div class="admin">Admin Dashboard</div>
		<div class="col">
			<h1><?php  echo $totalUsers; ?><h1>
			<h4>Total Users</h4>
		</div>
		<div class="col">
    <h1><?php echo $totalComplaints; ?><h1>
			<h4>Total complaints Hostel</h4>
		</div>
	</div>
</body>
</html>