<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta chrset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>admin panel</title>

	<!-- font link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

	<!-- CSS file link -->
	<link rel="stylesheet" href="css/admin_style.css"> 

</head>
<body>

<?php include 'admin_header.php'; ?>

<!--Admin dashboard start-->

<section class="dashboard">

	<h1 class="title">табло</h1>

	<div class="box-container">
		
		<div class = "box">
			<?php
				include 'config.php';

				$select_cars = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
				$number_of_cars = mysqli_num_rows($select_cars);

			?>
			<h3><?php echo $number_of_cars; ?></h3>
			<p>коли</p>
		</div>

		<div class = "box">
			<?php
				include 'config.php';

				$select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
				$number_of_users = mysqli_num_rows($select_users);

			?>
			<h3><?php echo $number_of_users; ?></h3>
			<p>потребители</p>
		</div>

		<div class = "box">
			<?php
				include 'config.php';

				$select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
				$number_of_admins = mysqli_num_rows($select_admins);

			?>

			<h3><?php echo $number_of_admins; ?></h3>
			<p>администратори</p>
		</div>


	</div>

</section>

<!--Admin dashboard end-->











<!-- Admin js file link-->
<script src="js/admin_script.js"></script>

</body>
</html>