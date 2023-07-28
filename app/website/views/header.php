<nav style="width:100%;z-index:99999" class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">
		<a class="navbar-brand" href="index.php">Track<span style="color:#b30f00 !important">Express</span></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>

		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item" id="home"><a style="font-size:17px !important" href="index.php" class="nav-link">Home</a></li>
				<li class="nav-item" id="about"><a style="font-size:17px !important" href="about.php" class="nav-link">About</a></li>
				<li class="nav-item" id="schedule"><a  style="font-size:17px !important" href="schedule.php" class="nav-link">Train Schedule</a></li>
				<!-- <li class="nav-item"><a href="tracking.php" class="nav-link">Tracking</a></li> -->
				<li class="nav-item"  id="contact"><a style="font-size:17px !important" href="contact.php" class="nav-link">Contact Us</a></li>
				<?php if (isset($_SESSION['customerID'])) {  ?>
				<li class="nav-item dropdown">
					<a style="font-size:17px !important" class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					My Account
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown" style="top: 85%;left: -30px;">
						<a class="dropdown-item" href="my_account.php"><i class="fa fa-user mr-2 text-dark" aria-hidden="true"></i>  My Account, <?php echo $cusName; ?></a>
						<a class="dropdown-item" href="booking_history.php"><i class="fa fa-history text-dark mr-2" aria-hidden="true"></i>History</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out text-dark mr-2" aria-hidden="true"></i>Log Out</a>
					</div>
				</li>
				<?php } ?>
					<?php if (!isset($_SESSION['customerID'])) {  ?>
				<li class="nav-item"><a style="font-size:17px !important" href="login/register.php" class="nav-link">Sign Up</a></li>
	          <li class="nav-item"><a style="font-size:17px !important" href="login/login.php" class="nav-link">Login</a></li>
<?php } ?>
			</ul>
		</div>
	</div>
</nav>