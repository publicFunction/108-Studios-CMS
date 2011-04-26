<?php 
include("include/header.php");
?>

<div class="main_holder">
    <div class="menu">
        <h1>Forgot Your Password</h1>
    </div>
    <div class="header">
        <p>So... You forgot your password! Hey we all make mistakes, so complete the form below and we will email you a new
            one ready for you to login with. The good news is that, there will be no need for another activation.  Just login
            with the password we supply and chnage it in the Your Account link on the right if this panel once you login.</p>
    </div>
    <div class="mainContent">
    <?php
	if (isset($_REQUEST['uForgot'])) {
		if (($_REQUEST['uName'] == "") || ($_REQUEST['uEmail'] == "") ) {
			echo "You have not entered sufficient information to allow us to remind you of your password...<br />";
			echo "<p><a href='./'>Continue</a></p>";
		} else {
			$uName = $_REQUEST['uName'];
			$eMail = $_REQUEST['uEmail'];
			echo "<div class='content1_admin'>
				<h4>Reminder</h4>";
			$chkUser = DB::dbQuery("SELECT * FROM adminlogin WHERE adminName ='".$uName."'", "0", "");
			$getUser = mysql_fetch_assoc($chkUser);
			$userCount = mysql_num_rows($chkUser);
			if ($getUser['adminEmail'] == $eMail) {
				//  TODO: Do email stuff with a password
				
				echo "	<p>Your Password has been sent to you...</p>
						<a href='./'>Login</a>
				";
			} else {
				echo "<p>We are unable to confirm that your user name and email address match.<br />";
				echo "For Security reasons we will not be sending you the password.</p>";
				echo "<p>To have your password reset automatically please click <a href='reset.php?u=".$eMail."'>here</a>.</p>";
				echo "<p>To have your password reset manualy please click <a href='mailto:support@home108.co.uk?subject=Password Reset'>here</a>.</p>";
			}
				echo "</div>";
		}
		echo "</div>";
	} else {
	?>
    
		<div class="content1_admin">
            <h4>Forgot Your Password</h4>
            <p>Please Enter you email address and your user name below:</p>
            <fieldset>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" name="forgotPass">
                <ol><label>User Name: </label><input type="text" name="uName" value="" /></ol>
                <ol><label>eMail Address: </label><input type="text" name="uEmail" value="" /></ol>
                <ol><input type="submit" class="submit" name="uForgot" value="Remind Me" /></ol>
            </form>
            </fieldset>
		</div>
	</div>
<?php
	}
require("include/footer.php");
?>
</div>

</body>
</html>