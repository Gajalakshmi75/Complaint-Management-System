<?php include('server3.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<style>
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
	</style>
</head>
<body>
	<div class="container">
		<h1>Admin Dashboard</h1>
		<div class="col">
			<h1>2000<h1>
			<h4>Total Users</h4>
		</div>
		<div class="col">
			<h1>20<h1>
			<h4>Total complaints</h4>
		</div>
		<div class="col">
			<h1>15<h1>
			<h4>Total solved</h4>
		</div>
	</div>
</body>
</html>