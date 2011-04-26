<?php

include("../header.php");

if ( ($_SESSION['login'] == false) && ($_SERVER['HTTP_REFERER'] == "http://www.home108.co.uk/admin/forgot.php" ) ){
	echo "
	<body>
	<div class='main_holder'>
		<div class='towerImg'>
        	<img src='../images/towerImg.jpg' alt='Tardis3dimage' />
		</div>
    	<div class='menu'>";
        require("../includes/menu.php");
		echo "</div>
		 <div class='header'>
			<p>welcome to <span id='makeGreen'>home108.co.uk</span></p>
		</div>
    	<div class='mainContent'>
			<div class='content1_admin'>";
			if ((isset($_REQUEST['u'])) && ($_REQUEST['u'] != "")) {
				$email = $_REQUEST['u'];
				$chkEmail = mysql_query("SELECT * FROM adminLogin WHERE adminEmail='".$email."'");
				$chkMailCount = mysql_num_rows($chkEmail);
				if ($chkMailCount < 1) {
					echo "The email address you supplied is not valid...<br />";
					echo "<p>No action has been taken, to have a full reset done please request a ";
					echo "<a href='mailto:support@home108.co.uk?subject=Password Reset'>manual reset</a> or ";
					echo "<a href='./'>continue</a></p>";
				} else {
					$newpass = substr(md5(uniqid(rand(), true)),0,8);
					$newpassUpdate = mysql_query("UPDATE adminLogin SET adminPass='".$newpass."' WHERE adminEmail='".$email."'");
					if (!$newpassUpdate) {
						echo "<p>Password Reset failed due to: ".mysql_error()."</p>";
						echo "<p>Please use the <a href='mailto:support@home108.co.uk?subject=Password Reset'>manual reset</a> method</p>";
					} else {
						echo "<p>Your password has been reset, an email will be sent to the address you provided.</p>";
						echo "<p>Please check your email for your new password, you may need to check your junk mail and add home108.co.uk to your safe senders list</p>";
						echo "<p><a href='./'>Continue</a></p>";
					}
				}
			}
	echo "	</div>
		</div>";
	require('footer.php');	
	echo "</div>
	</body>
	</html>";
	exit();
} else if ($_SESSION['login'] == true) {
	?>
	<div class='main_holder'>
		<div class='towerImg'>
        	<img src='../images/towerImg.jpg' alt='Tardis3dimage' />
		</div>
    	<div class="menu">
        <?php require("../includes/menu.php"); ?>
        </div>
         <div class="header">
            <p>welcome to <span id="makeGreen">home108.co.uk</span></p>
        </div>
    	<div class='mainContent'>
			<div class='content1_admin'>
				<p>You are already logged in, to reset your own password, please use the My Account Link in the Admin Menu</p>
                <p><a href='./'>Continue</a></p>
			</div>
		</div>
    <?php
	require('footer.php');	
	?>
    
	</div>
	</body>
	</html>
<?php
} else {
?>
	<div class='main_holder'>
		<div class='towerImg'>
        	<img src='../images/towerImg.jpg' alt='Tardis3dimage' />
		</div>
    	<div class="menu">
        <?php require("../includes/menu.php"); ?>
        </div>
         <div class="header">
            <p>welcome to <span id="makeGreen">home108.co.uk</span></p>
        </div>
    	<div class='mainContent'>
			<div class='content1_admin'>
				<p>We Are unable to determine who you are or your status on the site...</p>
                <p><a href='./'>Continue</a></p>
			</div>
		</div>
    <?php
	require('footer.php');	
	?>
    
	</div>
	</body>
	</html>
<?php
}
?>