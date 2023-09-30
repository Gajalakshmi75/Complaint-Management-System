<?php 
	session_start();

	// variable declaration
	$Student_Id = "";
	$cluster = "";
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
		$cluster = mysqli_real_escape_string($db1, $_POST['cluster']);
		$class = mysqli_real_escape_string($db1, $_POST['class']);
		$complaint_type = mysqli_real_escape_string($db1, $_POST['complaint_type']);
		$importance = mysqli_real_escape_string($db1, $_POST['importance']);
		$description = mysqli_real_escape_string($db1, $_POST['description']);

		// form validation: ensure that the form is correctly filled
		if (empty($Student_Id)) { array_push($errors, "Student_Id is required"); }
		if (empty($complaint_type)) { array_push($errors, "complaint_type is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($complaint_date)) { array_push($errors, "date is required"); }

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$query1 = "INSERT INTO collage (Student_Id, phoneno, email, cluster, class, complaint_type, importance, complaint_date, description) 
					  VALUES ('$Student_Id', '$phoneno', '$email', '$cluster', '$class', '$complaint_type', '$importance', '$complaint_date', '$description')";
			$results1 = mysqli_query($db1, $query1);
			if ($results1) {
				$_SESSION['success'] = "Your complaint is registered";
				header('location: problem.php');
				exit(); // Add this line to stop further execution after redirecting
			} else {
				array_push($errors, "Query execution failed: " . mysqli_error($db1));
			}
		}
	}
?>

<script>
		// JavaScript code to update issues dropdown based on complaint type
		document.addEventListener('DOMContentLoaded', function() {
			var complaintTypeDropdown = document.getElementById('complaint_type');
			var issuesDropdown = document.getElementById('issues');

			// Define the issues for each complaint type
			var issuesByComplaintType = {
				"leakage issue": ["Leak in the ceiling", "Leak in the walls", "Leak in the plumbing"],
				"Architecture issue": ["Broken furniture", "Damaged doors", "Faulty locks"],
				"Hygiene issue": ["Dirty common areas", "Garbage disposal problem", "Pest infestation"],
				"Electricity issue": ["Power outage", "Faulty wiring", "Broken switches"],
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

