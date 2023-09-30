<?php
session_start();

// Variable declaration
$Student_Id = "";
$cluster = "";
$errors = array();
$_SESSION['success'] = "";

// Connect to the database
$db1 = mysqli_connect('localhost', 'root', '', 'dbms');

// Register user
if (isset($_POST['sub_user'])) {
  // Retrieve the form data
  $complaint_date = mysqli_real_escape_string($db1, $_POST['complaint_date']);
  $Student_Id = mysqli_real_escape_string($db1, $_POST['Student_Id']);
  $phoneno = mysqli_real_escape_string($db1, $_POST['phoneno']);
  $email = mysqli_real_escape_string($db1, $_POST['email']);
  $cluster = mysqli_real_escape_string($db1, $_POST['cluster']);
  $class = mysqli_real_escape_string($db1, $_POST['class']);
  $complaint_type = mysqli_real_escape_string($db1, $_POST['complaint_type']);
  $importance = mysqli_real_escape_string($db1, $_POST['importance']);
  $description = mysqli_real_escape_string($db1, $_POST['description']);

  // Form validation: Ensure that the form is correctly filled
  if (empty($Student_Id)) {
    array_push($errors, "Student_Id is required");
  }
  if (empty($complaint_type)) {
    array_push($errors, "complaint_type is required");
  }
  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($complaint_date)) {
    array_push($errors, "Date is required");
  }

  // Register user if there are no errors in the form
  if (count($errors) == 0) {
    $query1 = "INSERT INTO collage (Student_Id, phoneno, email, cluster, class, complaint_type, importance, complaint_date, description) 
              VALUES ('$Student_Id', '$phoneno', '$email', '$cluster', '$class', '$complaint_type', '$importance', '$complaint_date', '$description')";
    $results1 = mysqli_query($db1, $query1);
    if ($results1) {
      $_SESSION['success'] = "Your complaint is registered";
      header('location: problem1.php');
      exit(); // Add this line to stop further execution after redirecting
    } else {
      array_push($errors, "Query execution failed: " . mysqli_error($db1));
    }
  }
}

// Include errors.php for displaying validation errors
include('errors.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script>
    // JavaScript code to update issues dropdown based on complaint type
    document.addEventListener('DOMContentLoaded', function() {
      var complaintTypeDropdown = document.getElementById('complaint_type');
      var issuesDropdown = document.getElementById('issues');

      // Define the issues for each complaint type
      var issuesByComplaintType = {
				"leakage issue": ["Leak in the ceiling", "Leak in the walls", "Leak in the plumbing","tap water leaking","drinking waterpipe damage"],
				"Carpentry issue": ["Broken furniture", "Damaged doors", "Faulty locks innner","faulty lock outer","missing racks","windows mess","cupboard door lock","cupboard door","cupboard door almarah"],
				"Cleaning/housekeeping issue": ["Dirty common areas","dogs ","monekeys excretion", "Garbage disposal problem","room cleaning","Pest infestation","washroom water blocking","floor cleaning","drinking water area cleaning","water tank cleaning","ground cleaning"],
				"Electricity issue": ["Power outage", "Faulty wiring", "Broken switches","fire in switches","fans speed","fan damage","light blinking"," tube light damage","comman area lights problem","washroom lights","AC speed","ac broken"],
				"Other issue": ["Other problem"]
			};

      // Function to update the issues dropdown options
      function updateIssuesDropdown() {
        var selectedComplaintType = complaintTypeDropdown.value;
        issuesDropdown.innerHTML = '';

        if (selectedComplaintType !== '') {
          // Add the default option
          var defaultOption = document.createElement('option');
          defaultOption.value = '';
          defaultOption.innerHTML = 'Select your issue';
          issuesDropdown.appendChild(defaultOption);

          // Add the issues for the selected complaint type
          issuesByComplaintType[selectedComplaintType].forEach(function(issue) {
            var option = document.createElement('option');
            option.value = issue;
            option.innerHTML = issue;
            issuesDropdown.appendChild(option);
          });
        }
      }

      // Update the issues dropdown when the complaint type changes
      complaintTypeDropdown.addEventListener('change', updateIssuesDropdown);

      // Update the issues dropdown on page load (if complaint type is already selected)
      updateIssuesDropdown();
    });
  </script>
</head>
<body>
  <div class="header">
    <h2>Student Complaints Page</h2>
  </div>

  <form method="post" action="collage.php">
    <?php include('errors.php'); ?>

    <div class="input-group">
      <label>Student Id</label>
      <input type="text" name="Student_Id" value="<?php echo $Student_Id; ?>">
    </div>
    <div class="input-group">
      <label>Phone No.</label>
      <input type="text" name="phoneno">
    </div>
    <div class="input-group">
      <label>Email</label>
      <input type="email" name="email">
    </div>
    <div class="input-group">
      <label for="cluster">Cluster</label>
      <select id="cluster" name="cluster">
        <option value="">Select your cluster</option>
        <option value="M">MUE</option>
        <option value="O">OMEGA</option>
        <option value="K">KAPPA</option>
        <option value="L">LAMDA</option>
        <option value="G">GAMMA</option>
        <option value="E">ETA</option>
        <option value="B">BETA</option>
        <option value="A">ALPHA</option>
      </select>
    </div>
    <div class="input-group">
      <label for="class">Class</label>
      <select id="class" name="class">
        <option value="">Select Your class</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
      </select>
    </div>
    <div class="input-group">
      <label for="complaint_type">Complaint Type</label>
      <select id="complaint_type" name="complaint_type">
        <option value="">Select Your Issue</option>
        <option value="leakage issue">Leakage issue</option>
        <option value="Architecture issue">Architecture issue</option>
        <option value="Hygiene issue">Hygiene issue</option>
        <option value="Electricity issue">Electricity issue</option>
        <option value="Other issue">Other issue</option>
      </select>
    </div>
    <div class="input-group">
      <label for="issues">Issue</label>
      <select id="issues" name="issue">
        <option value="">Select your issue</option>
      </select>
    </div>
    <div class="input-group">
      <label for="importance">priority</label>
      <select id="importance" name="importance">
        <option value="">Select</option>
        <option value="mild">Mild</option>
        <option value="moderate">Moderate</option>
        <option value="severe">Severe</option>
      </select>
    </div>
    <div class="input-group">
			<label for="slot">Available Time</label>
			<select id="slot" name="slot">
				<option value="">Select</option>
				<option value="1">9.00AM-10.00AM</option>
				<option value="2">10.00AM-11.00AM</option>
				<option value="3">11.00AM-12.00PM</option>
				<option value="4">12.00pM-1.00pM</option>
				<option value="5">01.00PM-02.00PM</option>
				<option value="6">02.00PM-03.00PM</option>
				<option value="7">03.00PM-04.00PM</option>
				<option value="8">04.00PM-05.00PM</option>
				<option value="9">05.00PM-06.00PM</option>
				<option value="10">06.00PM-07.00PM</option>
			</select>
		</div>
    <div class="input-group">
      <label for="complaint_date">Date of Complaint:</label>
      <input type="date" id="complaint_date" name="complaint_date" value="<?php echo date('Y-m-d'); ?>" readonly>
    </div>
    <div class="input-group">
      <label for="description">Problem Description</label>
      <textarea id="description" name="description" placeholder="Write something.." rows="10" cols="70"></textarea>
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="sub_user">Submit</button>
    </div>
    <p><a href="../index.php" style="background-color:red"><button>Logout</button></a></p>
  </form>
</body>
</html>
