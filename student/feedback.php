<?php include('server2.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Student Feedback Survey</h2>
	</div>


	<form method="post" action="main.php">


		<?php include('errors.php'); ?>


		<div class="input-group">
			<label>Student Id</label>
			<input type="text" name="Student_Id" value="<?php echo $Student_Id; ?>">
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
      			<option value="Carpentry issue">Architecture issue</option>
      			<option value="Cleaning/housekeeping issue">Hygiene issue</option>
      			<option value="Electricity issue">Electricity issue</option>
      			<option value="Other issue">Other issue</option>
    		</select>
		</div>

		<div class="rate">
		<h4>How would you rate your problem solved?</h4>
		<br>
       <input type="radio" id="star5" name="rate" value="5" />
        <label for="star5" title="text">5 stars</label>
        <input type="radio" id="star4" name="rate" value="4" />
        <label for="star4" title="text">4 stars</label>
        <input type="radio" id="star3" name="rate" value="3" />
        <label for="star3" title="text">3 stars</label>
        <input type="radio" id="star2" name="rate" value="2" />
        <label for="star2" title="text">2 stars</label>
        <input type="radio" id="star1" name="rate" value="1" />
        <label for="star1" title="text">1 star</label>
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