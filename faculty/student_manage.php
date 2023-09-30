<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  // Redirect to the login page or any other desired location
  header("Location: login.php");
  exit();
}

// Connect to the database
$db1 = mysqli_connect('localhost', 'root', '', 'dbms');
// Get the logged-in username
$username = $_SESSION['username'];

// Query to retrieve the complaints for the logged-in user
$query = "SELECT complaint_date, complaint_type,issue, description FROM faculty_complaints WHERE username = '$username'";
$result = mysqli_query($db1, $query) or die(mysqli_error($db1));
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

    table,
    th,
    td {
      border: 1px solid #FC66AA;
      border-collapse: collapse;
      padding: 1rem;
      color: black;
    }

    tbody {
      width: 95%;
      max-height: 89%;
      background-color: #fffb;
      margin: .8rem;
      border-radius: 0.6rem;
    }

    th,
    td {
      padding: 5px;
      text-align: left;
      background: transparent;

    }

    .dashboard {
      padding: 20px;
      background-color: #000080;
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
      border-radius: 0 20px 20px 0px;
      transition: .5rem;
      font-family: Georgia, 'Times New Roman', Times, serif;
      color: whitesmoke;

    }

    .page-title {
      font-size: 3rem;
      font-weight: 800;
      font-family: 'monotype corsiva';
      text-shadow: 2px black;

    }

    .sidebar a {
      display: block;
      color: white;
      padding: 16px;
      text-decoration: none;
    }

    .sidebar a.active {

      color: white;
    }

    .sidebar a:hover:not(.active) {
      background-color: #FF6EC7;
      color: black;
      border: black;
      margin-top: 10px;
      transition: 1rem;
    }


    @media screen and (max-width: 700px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }

      .sidebar a {
        float: left;
      }

      div.content {
        margin-left: 0;
      }
    }

    @media screen and (max-width: 400px) {
      .sidebar a {
        text-align: center;
        float: none;
      }
    }
    .container{
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 100px;
    }
    .h2{
      align-items: center;
    }
    .footer-btn{
      padding-top: 410px;
    }
    a button{
      background-color: #1338be;
      color:white;
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <div class="dashboard">DashBoard</div>
    <a href="#home">Home</a>
    <a href="main.php">Complaint Registration</a>
    <div class="footer-btn"><a href="logout.php">Logout</a></div>
  </div>
  <div class="container">
    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>Complaint Type</th>
          <th>issue</th>
          <th>Description</th>
          <th>Feedback</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['complaint_date'] . "</td>";
          echo "<td>" . $row['complaint_type'] . "</td>";
          echo "<td>" . $row['issue'] . "</td>";
          echo "<td>" . $row['description'] . "</td>";
          echo "<td><a href='./feedback.php'><button>Feedback</button></a></td>";

          echo "</tr>";
        }
        ?>
      </tbody>
  </div>

  </div>

</body>

</html>