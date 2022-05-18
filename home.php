<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
	header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta chrset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>home</title>

	<!-- font link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

	<!-- CSS file link -->
	<link rel="stylesheet" href="css/style.css"> 
</head>

<body>
	<?php include 'header.php'; ?>

	<section class="home">

		<div class="content">
			<h3>Автомобилите, които караме, казват много за нас</h3>
			<p>Намерете новата си кола в CarAvenue</p>
			<!-- <a href="about.php" class="white-btn">Научи повече</a> -->
		</div>

	</section>


	<section class="products">
		<div class="box-container">
			<?php 

				$select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
				if(mysqli_num_rows($select_products) > 0){
					while($fetch_products = mysqli_fetch_assoc($select_products)){				
			?>
			<form action="" method="post" class="box">
				
				<img src="uploaded_img/<?php echo $fetch_products['image'];?>" alt="">

				<table class="table_products">
					<tr>
						<td>Марка: </td>
						<td><div class="brand"><?php echo $fetch_products['brand']; ?></div></td>
					</tr>
					<tr>
						<td>Модел: </td>
						<td><div class="model"><?php echo $fetch_products['model']; ?></div></td>
					</tr>
					<tr>	
						<td>Тип: </td>
						<td><div class="type"><?php echo $fetch_products['type']; ?></div></td>
					</tr>
					<tr>
						<td>Цвят: </td>
						<td><div class="color"><?php echo $fetch_products['color']; ?></div></td>
					</tr>
					<tr>
						<td>Кубатура: &nbsp;&nbsp;</td>
						<td><div class="engine_capacity"><?php echo $fetch_products['engine_capacity']; ?> </div></td>
					</tr>
					<tr>
						<td>Разход: </td>
						<td><div class="fuel_consumption"><?php echo $fetch_products['fuel_consumption']; ?> </div></td>
					</tr>
				
				</table>

				<div class="price"><?php echo $fetch_products['price'];?> лв.</div>

				<!-- 
				<div class="brand"><?php echo $fetch_products['brand'];?></div>
				<div class="model"><?php echo $fetch_products['model'];?></div>
				<div class="type"><?php echo $fetch_products['type'];?></div>
				<div class="color"><?php echo $fetch_products['color'];?></div>
				<div class="engine_capacity"><?php echo $fetch_products['engine_capacity'];?></div>		
				<div class="fuel_consumption"><?php echo $fetch_products['fuel_consumption'];?></div> -->
				
			</form>

			<?php 
				}
			}else{
				echo '<p class="empty">Все още няма добавени коли</p>';
			}	
			?>
			
		</div>
	</section>


	<?php include 'footer.php'; ?>


	<script src="js/script.js"></script>
</body>

</html>