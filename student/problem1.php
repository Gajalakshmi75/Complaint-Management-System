<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Complaint Registered</title>
    <style>
        body{
            background-color: navy;
        }
        h1{
            text-align: center;
            font-family: 'cursive';
            color:white;
        }
        a{
            justify-content: center;
            align-items: center;
            display: flex;
            text-decoration: none;
        }
        button{
            background-color: green;
            padding: 10px;
            font-weight: 400;
            border-radius: 5px;
            color:white;
        }
        button:hover{
            color:black;
            background-color:greenyellow;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Complaint Registered</h1>
    <?php if (isset($_SESSION['success'])) : ?>
        <p><?php echo $_SESSION['success']; ?></p>
    <?php endif; ?>

    <!-- Button to go to the home page -->
    <a href="./collage_manage.php"><button>Go To Home</button></a>

    <?php unset($_SESSION['success']); ?>
</body>
</html>
