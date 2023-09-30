<?php
session_start();

// variable declaration
$Student_Id = "";
$roomno = "";
$errors = array();
$_SESSION['success'] = "";

if (isset($_POST['sub_user'])) {
  // Retrieve the form data
  $studentId = $_POST['Student_Id'];
  $phoneNo = $_POST['phoneno'];
  $email = $_POST['email'];
  $blockName = $_POST['block_name'];
  $floor = $_POST['floor'];
  $roomNo = $_POST['roomno'];
  $complaintType = $_POST['complaint_type'];
  $issue = $_POST['issue'];
  $importance = $_POST['importance'];
  $complaintDate = $_POST['complaint_date'];
  $description = $_POST['description'];

  // Validate and sanitize the form data as needed

  // Perform database insertion
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'dbms';

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $sql = 'INSERT INTO complaints (student_id, phoneno, email, block_name, floor, roomno, complaint_type, issue, importance, complaint_date, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sssssssssss', $studentId, $phoneNo, $email, $blockName, $floor, $roomNo, $complaintType, $issue, $importance, $complaintDate, $description);

  if ($stmt->execute() === TRUE) {
    echo 'Complaint saved successfully';
	header('location: student_manage.php');
  } else {
    echo 'Error: ' . $sql . '<br>' . $conn->error;
  }

  $stmt->close();
  $conn->close();
}

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
				"Electricity issue": ["Power outage", "Faulty wiring", "Broken switches","fire in switches","fans speed","fan damage","light blinking"," tube light damage","comman area lights problem","washroom lights"],
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


	<form method="post" action="main.php" onsubmit="return validateForm()">


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
			<label for="block_name">Block Name</label>
    		<select id="block_name" name="block_name">
    			<option value="">Select your Block</option>
      			<option value="k2">K2</option>
      			<option value="k3">K3</option>
      			<option value="k4">K4</option>
      			<option value="i3">I3</option>
      			<option value="i2">I2</option>
      			<option value="i1">I1</option>
    		</select>
		</div>
		<div class="input-group">
			<label for="floor">Floor No</label>
    		<select id="floor" name="floor">
      			<option value="">Select Your Floor</option>
      			<option value="G">ground floor</option>
      			<option value="F">First floor</option>
      			<option value="S">Second floor</option>
      			<option value="T">third floor</option>
    		</select>
		</div>
		<div class="input-group">
			<label>Room No.</label>
			<input type="text" name="roomno">
		</div>
		<div class="input-group">
			<label for="complaint_type">Complaint Type</label>
    		<select id="complaint_type" name="complaint_type">
    			<option value="Electricity issue">Select Your Issue</option>
    			<option value="leakage issue">leakage issue</option>
      			<option value="Carpentry issue">infrastructure issue</option>
      			<option value="Cleaning/housekeeping issue">Hygiene issue</option>
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
			<label for="importance">Priority</label>
    		<select id="importance" name="importance">
      			<option value="">Select</option>
      			<option value="mild">mild</option>
      			<option value="moderate">moderate</option>
      			<option value="severe">severe</option>
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
  <?php
    // Make a GET request to the WorldTimeAPI
    $url = "http://worldtimeapi.org/api/ip"; // Retrieve the date based on the client's IP address
    $data = file_get_contents($url);
    $response = json_decode($data, true);

    // Extract the current date from the response
    $currentDate = $response['datetime'];
    $currentDate = new DateTime($currentDate);

    // Format the date as per your requirement
    $formattedDate = $currentDate->format('Y-m-d');
  ?>
  <input type="date" id="complaint_date" name="complaint_date" value="<?php echo $formattedDate; ?>" readonly>
</div>


		<div class="input-group">
		<label for="description">Problem Description</label>
    	<textarea id="description" name="description" placeholder="Write something.." rows="10" cols="70"></textarea>
    	</div>
		
		<div class="input-group">
			<button type="submit" class="btn" name="sub_user">Submit</button>
		</div>
		<p> <a href="a.php?logout='1'" style="color: red;">logout</a> </p>
				
	</form>					
</body>
</html>
