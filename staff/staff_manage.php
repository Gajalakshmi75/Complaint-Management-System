<?php
session_start();
if (!isset($_SESSION['staffname'])) {
    header('location: login.php');
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "dbms");
$username = $_SESSION['staffname'];

$query = "
SELECT aa.Student_Id AS Student_Id, aa.roomno, aa.phoneno, aa.complaint_date, aa.slot, aa.complaint_type, aa.issue, aa.description, aa.importance
FROM complaints AS aa
INNER JOIN staff AS bb ON aa.complaint_type = bb.department
WHERE bb.staffname = '$username'
";

// Sort variables
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'complaint_date';
$sortOrder = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'DESC' : 'ASC';

// Append sort parameters to the query
$query .= " ORDER BY ";

if ($sortBy === 'importance') {
    $query .= "FIELD(aa.importance, 'mild', 'moderate', 'severe') " . $sortOrder;
} else {
    $query .= $sortBy . " " . $sortOrder;
}

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
table, th, td {
  border: 1px solid #FC66AA;
  border-collapse: collapse;
  padding: 1rem;
  color:black;
}
table{
  border-spacing: 2px; 
  background-color: #fff5;
  backdrop-filter: blur (7px);
  box-shadow: 0px .4rem .8rem #0005 ;
}
tbody{
  width: 95%;
  max-height: 89%;
  background-color: #fffb;
  margin: .8rem;
  border-radius: 0.6rem;
}
th, td {
  padding: 5px;
  text-align: left; 
  background: transparent;

}
#logout{
  border-radius: 10px;
  background-color:#FC66AA;
  color:white;
  padding: 15px;
  font-size: large;
  border: none;
  outline: none;
  cursor:pointer;

}
#logout:hover{
  color:black;
  background-color: pink;
  cursor: pointer;
  transition: 0.5s;
}
#sort{
  font-size: 1rem;
}
#order{
  font-size: 1rem;
}
#sorts{
  background: rgba(255, 255, 255, 0.1);
  padding:30px;
  border-radius: 5px;
  font-size: 1.5rem;
}
th{
  background-color: #FC66AA;
  color:white;
}
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
#del{
  background-color: red;
  border: none;
  outline:none;
  cursor: pointer;
  border-radius: 3px;
  color:white;
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
.page-title{
  font-size: 3rem;
  font-weight: 800;
  font-family: 'monotype corsiva';
  text-shadow: 2px black;

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

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

#sort_btn{
  color:navy;
  background-color: greenyellow;
  font-size: 1rem;
  border-radius: 10px;
  border: 2px solid black;
  padding:10px ;

  cursor: pointer;
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
  <a href="staff_manage.php">Hostel Complaint Details</a>
  <a href="campus_staff_manage.php">campus Complaint Details</a>
  <a href="faculty_staff_manage.php">faculty complaint Details</a>
</div>
<div class="content">

<div class="ts-main-content">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2 class="page-title">Hostel Complaints Details</h2>
          <div class="panel panel-default">
            <div class="panel-body">
              <form action="admin_studentdetail.php" method="get" id="sorts">
                <label for="sort">Sort By:</label>
                <select id="sort" name="sort">
                  <option value="complaint_type">Complaint Type</option>
                  <option value="complaint_date">Complaint Date</option>
                  <option value="importance">Importance</option>
                </select>
                <label for="order">Order:</label>
                <select id="order" name="order">
                  <option value="asc">Ascending</option>
                  <option value="desc">Descending</option>
                </select>
                <input type="submit" value="Sort" id="sort_btn">
              </form>
              <br>
              <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Student Id</th>
                    <th>Room No</th>
                    <th>Phone No</th>
                    <th>Complaint Date</th>
                    <th>Complaint Type</th>
                    <th>Issue</th>
                    <th>Description</th>
                    <th>slot</th>
                    <th>Importance</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>'.$row['Student_Id'].'</td>';
                    echo '<td>'.$row['roomno'].'</td>';
                    echo '<td>'.$row['phoneno'].'</td>';
                    echo '<td>'.$row['complaint_date'].'</td>';
                    echo '<td>'.$row['complaint_type'].'</td>';
                    echo '<td>'.$row['issue'].'</td>';
                    echo '<td>'.$row['description'].'</td>';
                    echo '<td>'.$row['slot'].'</td>';
                    echo '<td>'.$row['importance'].'</td>';
                    echo '</tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<p> <a href="logout.php" style="color: red;"><button id="logout"> logout</button></a> </p>

</body>
</html>
