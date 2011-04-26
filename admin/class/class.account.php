<?php

class account {
	
	public static function listAccounts() {
		echo "	<div class='pageContainer'>
					<p>Listing all Admin Accounts for editing</p>";
		$getAccounts = DB::dbQuery("SELECT adminID, adminFullname FROM adminlogin WHERE adminID != '".$_SESSION['userID']."';", "0");
		while ($adminList = mysql_fetch_assoc($getAccounts)) {
			echo "<div class='pageHolder'>
					<a href='?do=manageAcc&action=edit&user=".$adminList['adminID']."'>
					<img src='icons/admin_user.png' alt='Edit Administrator ".$adminList['adminID']."' />
					</a>";
			echo $adminList['adminFullname'];
			echo "</div>";
		}
		echo "</div>";
	}

    public static function addAccount() {
        if (isset($_REQUEST['addAccount'])) {
            $pass = actions::createPassword('12', '8');
            $encPass = actions::md5Pass($pass);
            $addUser = DB::dbQuery("INSERT INTO adminlogin VALUES ('','".$_REQUEST['adminName']."','".mysql_real_escape_string($encPass)."', '".$_REQUEST['adminFullname']."', '1','".$_REQUEST['adminEmail']."', '".$_REQUEST['newRight']."');","0");
            if (!$addUser) {
                echo "<p>There was an issue creating ".$_REQUEST['adminFullname']."'s account.  Please
                    alert a system administrator, so this issue can be resolved.</p>";
            } else {
                $actiCode = actions::createPassword('20', '4');
                $getLastEntry = DB::dbQuery("SELECT adminID FROM adminlogin ORDER BY adminID DESC LIMIT 1;","0");
                $newID = DB::dbFetch($getLastEntry,'assoc');
                $addActivation = DB::dbQuery("INSERT INTO adminactivation VALUES ('','".$newID['adminID']."','".$actiCode."','1');","0");
                if (!$addActivation) {
                    echo "<p>There was an issue setting up the activation for ".$_REQUEST['adminFullname']."'s account.  Please
                    alert a system administrator, so this issue can be resolved.</p>";
                } else {
                    echo "<p>A new account for ".$_REQUEST['adminFullname']." has been created.</p>";
                }
            }
        } else {
           $getRightsList = DB::dbQuery("SELECT rightsValue, rightsName FROM adminrights ORDER BY rights_ID ASC;","0");
            echo "<form action='?do=manageAcc&action=add' method='post'>
                            <fieldset>
                                <legend>Create a New Account</legend>
                                <ol>
                                    <li><label>Account Name:</label><input name='adminName' type='text' value='' /></li>
                                    <li><label>Account Password:</label><input name='adminPass' type='text' value='' /></li>
                                    <li><label>Account Name:</label><input name='adminFullname' type='text' value='' /></li>
                                    <li><label>Account Email:</label><input name='adminEmail' type='text' value='' /></li>
                                    <li><label>Account Access:</label><input name='adminRights' type='hidden' value='' />
                                                <select name='newRight'>";
                                                while ($rights = mysql_fetch_assoc($getRightsList)) {
                                                    echo "<option value='".$rights['rightsValue']."'>".$rights['rightsName']."</option>";
                                                }
                                    echo "  </select>
                                    </li>
                                    <li><label>&nbsp;</label><input name='addAccount' type='submit' value='Add' /></li>
                                </ol>
                            </fieldset>
                        </form>";
        }
    }

    public static function updateAccount() {
            $pass = actions::md5Pass($_REQUEST['adminPass']);
            $updateAccount = DB::dbQuery("UPDATE adminlogin SET adminPass='".$pass."', adminFullname='".$_REQUEST['adminFullname']."', adminEmail='".$_REQUEST['adminEmail']."' WHERE adminID='".$_REQUEST['adminID']."'", "1", "");
            echo "<p>Thank you.  The account details of ".$_REQUEST['adminFullname']." have been amended to the settings you specified. Please click the green arrow to return to the home page or use the menu above.</p>";
    }

	public static function editAccount() {
			$getAccount = DB::dbQuery("SELECT adminlogin.adminID, adminlogin.adminName, adminlogin.adminPass, adminlogin.adminFullname, adminlogin.adminStatus, adminlogin.adminEmail, adminlogin.adminRight, adminrights.rightsValue, adminrights.rightsName FROM adminlogin INNER JOIN adminrights WHERE adminlogin.adminRight = adminrights.rightsValue AND adminlogin.adminID = '".$_REQUEST['user']."';", "0");
			$account = mysql_fetch_assoc($getAccount);
			echo "<form action='?do=manageAcc&action=update' method='post'>
						<input name='adminID' type='hidden' value='".$account['adminID']."' />
						<fieldset>
							<legend>".$account['adminFullname']."&rsquo;s Account</legend>
							<ol>
								<li><label>Account Name:</label><input name='adminName' type='text' value='".$account['adminName']."' readonly /></li>
								<li><label>Account Password:</label><input name='adminPass' type='text' value='".actions::unmd5Pass($account['adminPass'])."' /></li>
								<li><label>Your Name:</label><input name='adminFullname' type='text' value='".$account['adminFullname']."' /></li>
								<li><label>Your Email:</label><input name='adminEmail' type='text' value='".$account['adminEmail']."' /></li>
								<li><label>Your Status:</label><input name='adminStatus' type='hidden' value='".$account['adminStatus']."' />";
							if ($account['adminStatus'] != "1") {
							   echo "<span>Inactive</span><a href='?do=myAccout&action=activate'>Active Now</a></li>";
							} else {
							   echo "<span>Active</span></li>";
							}
			echo "  			<li><label>Your Access:</label><input name='adminRights' type='hidden' value='".$account['rightsValue']."' />";
							if ($account['adminRight'] != "1") {
								echo "	<span>".$account['rightsName']."</span>";
							} else {
								$getRightsList = DB::dbQuery("SELECT rightsValue, rightsName FROM adminrights ORDER BY rights_ID;", "0");
								echo "<span>".$account['rightsName']." | Change to: </span>
											<select name='newRight'>";
											while ($rights = mysql_fetch_assoc($getRightsList)) {
												echo "<option value='".$rights['rightsValue']."'>".$rights['rightsName']."</option>";
											}
								echo "  </select>";
							}
			echo "       		</li>
								<li><label>&nbsp;</label><input name='updateAccount' type='submit' value='Save' /></li>
							</ol>
						</fieldset>
					</form>";
	}
	
    public static function myAccount() {
		if (isset($_REQUEST['updateAccount']) ) {
			if ($_REQUEST['action'] == "update") {
                $pass = actions::md5Pass($_REQUEST['adminPass']);
                $updateAccount = DB::dbQuery("UPDATE adminlogin SET adminPass='".$pass."', adminFullname='".$_REQUEST['adminFullname']."', adminEmail='".$_REQUEST['adminEmail']."', adminRight='".$_REQUEST['newRight']."' WHERE adminID='".$_SESSION['userID']."'", "1", "");
                echo "<p>Thank you.  Your account details have been amended to the settings you specified. Please click the green arrow to return to the home page or use the menu above.</p>";
            } else {
				echo "STOP CHANGING THE URL PARAMETERS";
            }
        } else {
			$getAccount = DB::dbQuery("SELECT adminlogin.adminID, adminlogin.adminName, adminlogin.adminPass, adminlogin.adminFullname, adminlogin.adminStatus, adminlogin.adminEmail, adminlogin.adminRight, adminrights.rightsValue, adminrights.rightsName FROM adminlogin INNER JOIN adminrights WHERE adminlogin.adminRight = adminrights.rightsValue AND adminlogin.adminID = '".$_SESSION['userID']."';", "0");
			$account = mysql_fetch_assoc($getAccount);
			echo "<form action='?do=myAccount&action=update' method='post'>
						<fieldset>
							<legend>My Account - ".$account['adminFullname']."</legend>
							<ol>
								<li><label>Account Name:</label><input name='adminName' type='text' value='".$account['adminName']."' readonly /></li>
								<li><label>Account Password:</label><input name='adminPass' type='text' value='".actions::unmd5Pass($account['adminPass'])."' /></li>
								<li><label>Your Name:</label><input name='adminFullname' type='text' value='".$account['adminFullname']."' /></li>
								<li><label>Your Email:</label><input name='adminEmail' type='text' value='".$account['adminEmail']."' /></li>
								<li><label>Your Status:</label><input name='adminStatus' type='hidden' value='".$account['adminStatus']."' />";
							if ($account['adminStatus'] != "1") {
							   echo "<span>Inactive</span><a href='?do=myAccout&action=activate'>Active Now</a></li>";
							} else {
							   echo "<span>Active</span></li>";
							}
			echo "  			<li><label>Your Access:</label><input name='adminRights' type='hidden' value='".$account['rightsValue']."' />";
							if ($account['adminRight'] != "1") {
								echo "	<span>".$account['rightsName']."</span>";
							} else {
								$getRightsList = DB::dbQuery("SELECT rightsValue, rightsName FROM adminrights ORDER BY rights_ID;", "0");
								echo "<span>".$account['rightsName']." | Change to: </span>
											<select name='newRight'>";
											while ($rights = mysql_fetch_assoc($getRightsList)) {
												echo "<option value='".$rights['rightsValue']."'>".$rights['rightsName']."</option>";
											}
								echo "  </select>";
							}
			echo "       		</li>
								<li><label>&nbsp;</label><input name='updateAccount' type='submit' value='Save' /></li>
							</ol>
						</fieldset>
					</form>";
		}
    }
}

?>