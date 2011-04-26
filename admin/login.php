<?php

include("include/header.php");

if (isset($_SESSION['login']) && $_SESSION['login'] == false || $_SESSION['login'] == null) {
    echo "  <div class='main_holder'>
                <div class='mainImgHolder'>
                    <div class='mainImg'>";
                     echo pageSetup::loadPageHeadImgAdmin();
    echo "      </div>
            </div>
    	<div class='menu'>
		</div>
     	<div class='header'>
        	<p>welcome to <span id='makeGreen'>home108.co.uk</span></p>
		</div>
    	<div class='mainContent'>
			<div class='content1_admin'>
				<p>You are Not allowed to access this page directly...<br /><a href='./' title='Return to Login Page'>Please log in...</a></p>
			</div>
		</div>";
	require('include/footer.php');
        die();
}

?>

<div class="main_holder">
    <div class="mainImgHolder">
        <div class="mainImg">
             <?php
                echo pageSetup::loadPageHeadImgAdmin();
             ?>
        </div>
    </div>
    <div class="title">
		<h3>Site Administration Page</h3>
    </div>
    <div class="header">
        <div class='welcome'>
            <h3>Welcome - <?php echo $_SESSION['fullUser']; ?></h3>
        </div>
        <div class="myAccount">
        	<a href="login.php?do=myAccount" title="Edit my Account">
                <img src="icons/user.png" alt="My Account" />
                <span>Your Account</span>
            </a>
        </div>
        <div class='logout'>
			<a href='index.php?do=logout' title='Log out of the admin section'></a>
		</div>
        <div class='home'>
        	<a href="login.php" title="Home"><img src="icons/back.png" alt="Home" /></a>
        </div>
        <?php
			
			if (admin::chkExtendedRights()) {
				echo "
				<div class='extAccount'>
                    <a href='login.php?do=manageAcc&amp;action=add' title='Create a New Account'>
                    <img src='icons/add_user.png' alt='Create a New Account' />
                    <span>Create</span>
                    </a>
					<a href='login.php?do=manageAcc' title='Manage Site Accounts'>
                    <img src='icons/users.png' alt='Manage Site Accounts' />
                    <span>Manage</span>
                    </a>
				</div>
				";
			}
		?>
        <br />
	</div>
    <br />
</div>
<?php
	if (admin::getAdminStatus()) {
            echo "	<div class='menu'>";
            menus::menuLinks('admin');
            echo "	</div>
                            <div class='content1_admin'>";
            if (isset($_REQUEST['do'])) {
                    $do = $_REQUEST['do'];
            } else {
                    $do = "";
            }
            if (isset($_REQUEST['action'])) {
                    $action = $_REQUEST['action'];
            } else {
                    $action = "";
            }
            admin::setDo($do, $action);
            echo "<br /></div>";
	} else {
            echo "<div class='content1_admin'>";
            admin::showActivationMsg();
            echo "<br /></div>";
        }
require("include/footer.php");
?>