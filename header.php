<header class="header">

	<div class="header-1">
		<div class="flex">
			<div class="share">
				<a href="#" class="fab fa-facebook-f"></a>
				<a href="#" class="fab fa-twitter"></a>
				<a href="#" class="fab fa-instagram"></a>
				<a href="#" class="fab fa-linkedin"></a>
			</div>
			<p>нов <a href="login.php">вход</a> | <a href="register.php"> регистрация</a></p>
		</div>
	</div>

	<div class="header-2">
		<div class=flex>
			<img src="images/logo_purple3.png">
			<!--<a href="home.php" class="logo">CarAvenue</a>-->

			<nav class="navbar">
				<a href="home.php">Начало</a>
				<!--<a href="about.php">За нас</a>-->
			</nav>

			<div class="icons">
				<div id="menu-btn" class="fas fa-bars"></div>
				<a href="search_page.php" class="fas fa-search"></a>
				<div id="user-btn" class="fas fa-user"></div>

			</div>
			<div class="user-box">
				<p>потребител: <span><?php echo $_SESSION['user_name']; ?></span></p>
				<p>имейл: <span><?php echo $_SESSION['user_email']; ?></span></p>
				<a href="logout.php" class="delete-btn">logout</a>
			</div>
		</div>
	</div>

</header>

