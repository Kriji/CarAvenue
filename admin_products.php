<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){
	$unique_number = mysqli_real_escape_string($conn, $_POST['unique_number']);
	$brand = mysqli_real_escape_string($conn, $_POST['brand']);
	$model = mysqli_real_escape_string($conn, $_POST['model']);
	$type = mysqli_real_escape_string($conn, $_POST['type']);
	$color = mysqli_real_escape_string($conn, $_POST['color']);
	$engine_capacity = $_POST['engine_capacity'];
	$fuel_consumption = $_POST['fuel_consumption'];
	$price = $_POST['price'];
	$image = $_FILES['image']['name'];
  $image_size = $_FILES['image']['size'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = 'uploaded_img/'.$image;

	$select_product_number = mysqli_query($conn, "SELECT unique_number FROM `products` WHERE unique_number = '$unique_number'") or die('query failed');

	if(mysqli_num_rows($select_product_number) > 0){
		$message[] = 'Колата вече е добавена';
	}else{
		$add_product_query = mysqli_query($conn, "INSERT INTO `products`(unique_number, brand, model, type, color, engine_capacity, fuel_consumption, price, image) VALUES ('$unique_number', '$brand', '$model', '$type', '$color', '$engine_capacity', '$fuel_consumption', '$price', '$image')") or die('query failed');

		if($add_product_query){
			if($image_size > 2000000){
				$message[] = 'Размерът на снимката е прекалено голям!';
			}else{
				move_uploaded_file($image_tmp_name, $image_folder);
				$message[] = 'Колата е добавена успешно!';
			}	
		}else{
			$message[] = 'Колата не беше добавена!';
		}
	}
}

if(isset($_GET['delete'])){
	$delete_id = $_GET['delete'];
	$delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
	$fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
	unlink('uploaded_img'.$fetch_delete_image['image']);
	mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
	header('location:admin_products.php');
}


if(isset($_POST['update_product'])){

	$update_p_id = $_POST['update_p_id'];
	$update_unique_number = $_POST['update_unique_number'];
	$update_brand = $_POST['update_brand'];
	$update_model = $_POST['update_model'];
	$update_type = $_POST['update_type'];
	$update_color = $_POST['update_color'];
	$update_engine_capacity = $_POST['update_engine_capacity'];
	$update_fuel_consumption = $_POST['update_fuel_consumption'];
	$update_price = $_POST['update_price'];

	mysqli_query($conn, "UPDATE `products` SET unique_number='$update_unique_number', brand = '$update_brand', model = '$update_model', type = '$update_type', color = '$update_color', engine_capacity = '$update_engine_capacity', fuel_consumption = '$update_fuel_consumption', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

	$update_image = $_FILES['update_image']['name'];
   	$update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   	$update_image_size = $_FILES['update_image']['size'];
   	$update_folder = 'uploaded_img/'.$update_image;
   	$update_old_image = $_POST['update_old_image'];

   	if(!empty($update_image)){
    	if($update_image_size > 2000000){
        	$message[] = 'image file size is too large';
      }else{
        mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
        move_uploaded_file($update_image_tmp_name, $update_folder);
        unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta chrset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>products</title>

	<!-- font link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

	<!-- CSS file link -->
	<link rel="stylesheet" href="css/admin_style.css"> 

</head>
<body>

<?php include 'admin_header.php'; ?>


<!-- Product CRUD start-->

<section class="add-products">
	
	<h1 class="title">налични коли</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<h3>добави  кола</h3>
		
		<!-- марка -->
		<input type="text" name="unique_number" class="box" placeholder="единен номер" required>

		<input type="text" name="brand" class="box" placeholder="марка" required>
		
		<!-- модел -->
		<input type="text" name="model" class="box" placeholder="модел" required>
		
		<!-- тип -->
		<select name="type" class="box" required>
			<option value="Седан">Седан</option>
			<option value="Хечбек">Хечбек</option>
			<option value="Лифтбек">Лифтбек</option>
			<option value="Комби">Комби</option>
			<option value="Купе">Купе</option>
			<option value="Кабриолет">Кабриолет</option>
			<option value="Лимузина">Лимузина</option>
			<option value="suv">suv</option>
			<option value="миниван">миниван</option>
			<option value="пикап">пикап</option>
		</select>

		<!-- цвят -->
		<select name="color" class="box" required>
			<option value="черен">червен</option>
			<option value="зелен">зелен</option>
			<option value="бял">бял</option>
			<option value="син">син</option>
			<option value="черен">черен</option>
			<option value="жълт">жълт</option>
			<option value="сребрист">сребрист</option>
		</select>

		<!-- кубатура на двигателя -->
		<input type="number" min="0" name="engine_capacity" class="box" placeholder="кубатура на двигателя" required>

		<!-- раход на 100 км -->
		<input type="number" min="0" name="fuel_consumption" class="box" placeholder="разход на гориво" required>

		<!-- цена -->
		<input type="number" min="0" name="price" class="box" placeholder="цена" required>

		<!-- снимка -->
		<input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>

		<input type="submit" value="добави" name="add_product" class="btn">
	</form>
</section>

<!-- Product CRUD end-->

<!-- show products -->

<section  class="show-products">
	<div class="box-container">

		<?php
			$select_products = mysqli_query($conn, "SELECT * from `products`") or die('query failed');
			if(mysqli_num_rows($select_products) > 0){
				while($fetch_products = mysqli_fetch_assoc($select_products)){
		?>
		<div class="box">
			<div class="unique_number">единен номер: <?php echo $fetch_products['unique_number']; ?></div>
			<img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">	
			
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
			
         	<div class="price"><?php echo $fetch_products['price']; ?> лв</div>
			
         	<a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">редактирай</a>
         	<a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Сигурен ли си, че искаш да изтриеш тази кола?')">изтрий</a>
		</div>
		
		<?php
			}
		}else{
			echo '<p class="empty">все още няма добавени коли</p>';
		}
		?>
	</div>
</section>

<!-- show products -->

<!-- UPDATE -->
<section class="edit-product-form">
	<?php 
		if(isset($_GET['update'])){
			$update_id = $_GET['update'];
			$update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or dire('query failed');
			if(mysqli_num_rows($update_query) > 0){
				while($fetch_update = mysqli_fetch_assoc($update_query)){
	?>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id'];?>">

		<input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image'];?>">
		
		<img src="uploaded_img/<?php echo $fetch_update['image'];?>" alt="">

		<input type="text" name="update_unique_number" value="<?php echo $fetch_update['unique_number'];?>" class="box" required placeholder="въведи единен номер">
		
		<input type="text" name="update_brand" value="<?php echo $fetch_update['brand'];?>" class="box" required placeholder="въведи марка">
		
		<input type="text" name="update_model" value="<?php echo $fetch_update['model'];?>" class="box" required placeholder="въведи модел">
		
		<select name="update_type" value="<?php echo $fetch_update['type'];?>" class="box" required>
			<option value="Седан">Седан</option>
			<option value="Хечбек">Хечбек</option>
			<option value="Лифтбек">Лифтбек</option>
			<option value="Комби">Комби</option>
			<option value="Купе">Купе</option>
			<option value="Кабриолет">Кабриолет</option>
			<option value="Лимузина">Лимузина</option>
			<option value="suv">suv</option>
			<option value="миниван">миниван</option>
			<option value="пикап">пикап</option>
		</select>

		<!-- цвят -->
		<select name="update_color" value="<?php echo $fetch_update['color'];?>" class="box" required>
			<option value="червен">червен</option>
			<option value="зелен">зелен</option>
			<option value="бял">бял</option>
			<option value="син">син</option>
			<option value="жълт">жълт</option>
			<option value="черен">черен</option>
			<option value="сребрист">сребрист</option>
		</select>

		<!-- кубатура на двигателя -->
		<input type="number" min="0" name="update_engine_capacity" value="<?php echo $fetch_update['engine_capacity'];?>" class="box" placeholder="въведи кубатура на двигателя" required>

		<!-- раход на 100 км -->
		<input type="number" min="0" name="update_fuel_consumption" class="box" value="<?php echo $fetch_update['fuel_consumption'];?>" placeholder="въведи разход на гориво" required>

		<!-- цена -->
		<input type="number" min="0" name="update_price" class="box" value="<?php echo $fetch_update['price'];?>" placeholder="въведи цена" required>

		<input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">

		<input type="submit" value="редактирай" name="update_product" class="btn">
		<input type="reset" value="откажи" id="close-update" name="update_product" class="option-btn">
	</form>
	<?php 
			}
		}
		}else{
			echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
		}
	?>
</section>


<!-- Admin js file link-->
<script src="js/admin_script.js"></script>

</body>
</html>