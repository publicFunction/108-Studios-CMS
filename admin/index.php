<?php
require("include/header.php");

?>

<div class="main_holder">
    <div class="mainImgHolder">
        <div class="mainImg">
             <?php
                echo pageSetup::loadPageHeadImgAdmin();
             ?>
        </div>
    </div>
     <div class="header">
        <p>welcome to <span id="makeGreen">your adminstration</span></p>
	</div>
    <div class="mainContent">
		<?php
                $do = "";
		if (isset($_REQUEST['do'])) {
                    if ($_REQUEST['do'] == "logout") {
                        $do = "1";
                    }
		} else {
                    $do = "";
		}
		switch ($do) {
                    case "1":
                        if (isset($_SESSION['login'])) {
                           $_SESSION['login'] == false;
                           session_unset();
                        }
                        echo "<div class='content1_admin'>";
                        echo "<p>You Are Now Logged Out...</p>";
                        echo "<p><a href='./'>Log In Again?</a></p>";
                        echo "<p><a href='../'>Go to Home Page?</a></p>";
                        echo "</div>
                            </div>";
                        break;
                    default:
                        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                            echo "<div class='content1_admin'>";
                            echo "	<div class='content1'>";
                            echo "		<p>".$_SESSION['fullUser']." you are already logged in...</p>";
                            echo "		<p><a href='login.php'>Continue to the Control Panel</a></p>";
                            echo "	</div>
                                    </div>";
                        } else {
                            if (isset($_REQUEST['uLogin'])) {
                                // Login Code - Set Session up to keep login as safe as I can...
                                $aName = $_REQUEST['uName'];
                                $aPass = $_REQUEST['uPass'];
                                $loginSQL = mysql_query("SELECT * FROM adminlogin WHERE adminName ='".$aName."' LIMIT 1");
                                $loginRes = mysql_fetch_assoc($loginSQL);
                                $loginCount = mysql_num_rows($loginSQL);
                    ?>
                    <?php
                                    $loggedinUser = "";
                                    if ($loginCount < 1) {
                                        echo "<div class='content1_admin'>
                                                        <h3>Admin Login Page</h3>";
                                        echo "<p>We were unable to find your login name...</p>";
                                        echo "<p><a href='./'>Try Again?</a>";
                                        echo "</div>";
                                    } else {
                                            $aName = strtolower($aName);
                                            $aPass = strtolower($aPass);
                                            $dbaName = strtolower($loginRes['adminName']);
                                            $dbaPass = $loginRes['adminPass'];
                                            if ($aName == $dbaName) {
                                                if (actions::md5Pass($aPass) == $dbaPass) {
                                                    $_SESSION['login'] = true;
                                                    $_SESSION['userID'] = $loginRes['adminID'];
                                                    $currUser = $aPass;
                                                    $fullUser = $loginRes['adminFullname'];
                                                    $_SESSION['currUser'] = $currUser;
                                                    $_SESSION['fullUser'] = $fullUser;
                                                    echo "<div class='content1_admin'>";
                                                    echo "<h3>Site Administration Page</h3>";
                                                    echo "	<div class='welcome'>
                                                                            <strong>Welcome - ".$_SESSION['fullUser']."</strong>
                                                                    </div>";
                                                    echo "	<div class='logout'>
                                                                            <a href='index.php?do=logout' title='Log Out'></a>
                                                                    </div>";
                                                    echo "<div class='content1'>";
                                                    echo "<p>Log In Successful</p>";
                                                    echo "<p><a href='login.php'>Continue to the Control Panel</a></p>";
                                                    echo "</div>";
                                                    echo "</div>";
                                                } else {
                                                    echo "<div class='content1_admin'>
                                                                    <h3>Admin Login Page</h3>";
                                                    echo "<p>Your Login Name and Password do not match...</p>";
                                                    echo "<p><a href='./'>Try Again?</a></p>";
                                                    echo "</div>";
                                                }
                                            }
                                        }
                                ?>
                        </div>
                <?php
                } else {
                ?>
                        <div class="content1_admin">
                                <h4>Admin Login Page</h4>
                                <p>Please Login with your details below:</p>
            <fieldset>
                                <form action="<?php $postback ?>" method="post">
                                        <ol>
                        <li><label>User Name: </label><input type="text" name="uName" value="" /></li>
                                                <li><label>Password : </label><input type="password" name="uPass" value="" /></li>
                                                <li><label>&nbsp;</label><input type="submit" class="submit" name="uLogin" value="Login" /></ol></li>
                                </form>

            <p><a href="forgot.php" title="Forgotten Your Password">Forgot your password?</a></p>
            </fieldset>
                        </div>
                </div>
                <?php
                }
        }


                    break;
}
		
require("include/footer.php");
?>
