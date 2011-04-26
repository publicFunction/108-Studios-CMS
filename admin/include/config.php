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
$classDir = opendir('class');

if ($classDir) {
	while (false !== ($file = readdir($classDir))) {
		if ($file != "." && $file != ".." && $file != ".svn") {
			require('class/'.$file);
		}
	}
}
closedir($classDir);
/**
**	Connect to the DB
**/
$setup = DB::dbSetup($base['DBSrv'], $base['DBUser'], $base['DBPass'], $base['DBSel']);
?>