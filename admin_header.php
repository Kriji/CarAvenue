<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<header class="header">

	<div class="flex">
		<a href="admin_page.php" class="logo">Админ<span>Панел</span></a>

		<nav class="navbar">
			<a href="admin_page.php">начало</a>
			<a href="admin_products.php">коли</a>
			<!--<a href="admin_orders.php">поръчки</a>-->
			<a href="admin_users.php">потребители</a>
			<!--<a href="admin_contacts.php">съобщения</a>-->
		</nav>

		<div class="icons">
			<div id="menu-btn" class="fas fa-bars"></div>
			<div id="user-btn" class="fas fa-user"></div>
		</div>

		<div class="account-box">
			<p>Име : 
				<span>
					<?php
					echo $_SESSION['admin_name']; 
					?>
				</span>
			</p>
        	<p>Имейл : 
        		<span>
        			<?php echo $_SESSION['admin_email']; ?>	
        		</span>
        	</p>
        	<a href="logout.php" class="delete-btn">изход</a>
		</div>

	</div>

</header>