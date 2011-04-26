<?php
/**
**	Complete the DB connection Info here - This is the only section you need to edit.
**  Editing anything other than the Database Information will cause the site to break
**/
/*	Server should always be localhost, if not please change it to the correct name, avoid the use of IP addresses */
$base['DBSrv'] = "localhost";
/*	Enter the username required to access the Server here, if you do not know this, contact your system admin or host provider */
$base['DBUser'] = "chris_dev";
/*	Enter the password required to access the Server here, if you do not know this, contact your system admin or host provider */
$base['DBPass'] = "dev";
/*	Enter your Database name here, if you do not know this, contact your system admin or host provider */
$base['DBSel'] = "108studioscms";

/*  DO NOT EDIT BELOW THIS LINE */
/*
**	Include all class files in the config file, this allows classes to be called at anytime
**	Please note that if your system is old and slow, get a new one, but if you experience any issues
**	then remove this section of code (INC ALL CLASS) and call the required file individually :S.
*/

$classDir = opendir('admin/class/');

if ($classDir) {
	while (false !== ($file = readdir($classDir))) {
		if ($file != "." && $file != ".." && $file != ".svn") {
			require('admin/class/'.$file);
		}
	}
}
closedir($classDir);
/**
**	Connect to the DB, Fail to install if it doesn't exist.
**/
$setup = DB::dbSetup($base['DBSrv'], $base['DBUser'], $base['DBPass'], $base['DBSel']);
$check = DB::dbQuery("SELECT reg_value FROM register WHERE reg_param='ADMIN_DIR';", "1");
/*  Check to see if the actual DB has been created that is listed in the config file   */
if (!$setup) {
    header('Location: install/index.php?stat=SETUPDB');
    break;
}
if($check == "" || $check == null) {
    header('Location: install/index.php?stat=INSTALL');
    break;
}

/**
**	Setup the Defaults from the DB (register) and pass into these variables
**/
$baseSet = array();
$vars = DB::dbQuery("SELECT reg_param, reg_value FROM register ORDER BY reg_ID ASC;", "0");
while ($data = mysql_fetch_array($vars)) {
    define($data['reg_param'], $data['reg_value']);
}

?>