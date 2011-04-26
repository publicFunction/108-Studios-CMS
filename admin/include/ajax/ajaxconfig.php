<?php
/**
**	Standard Variables, are set in the DB and are called here once a DB connection is established
**/

$base[''] = "";

/*
**	Include all class files in the config file, this allows classes to be called at anytime
**	Please note that if your system is old and slow, get a new one, but if you experience any issues
**	then remove this section of code (INC ALL CLASS) and call the required file individually :S.
*/

$classDir = opendir('../../class');

if ($classDir) {
	while (false !== ($file = readdir($classDir))) {
		if ($file != "." && $file != ".." && $file != ".svn") {
			require('../../class/'.$file);
		}
	}
}
closedir($classDir);
/**
**	Complete the DB connection Info here
**/

if ($_SERVER['HTTP_HOST'] != "localhost") {
    /*	Server should always be localhost, if not please change it to the correct name, avoid the use of IP addresses */
    $base['DBSrv'] = "db2836.oneandone.co.uk";
    /*	Enter the username required to access the Server here, if you do not know this, contact your system admin or host provider */
    $base['DBUser'] = "dbo356249196";
    /*	Enter the password required to access the Server here, if you do not know this, contact your system admin or host provider */
    $base['DBPass'] = "techcon2011";
    /*	Enter your Database name here, if you do not know this, contact your system admin or host provider */
    $base['DBSel'] = "db356249196";
} else {
    /*	Server should always be localhost, if not please change it to the correct name, avoid the use of IP addresses */
    $base['DBSrv'] = "localhost";
    /*	Enter the username required to access the Server here, if you do not know this, contact your system admin or host provider */
    $base['DBUser'] = "chris_dev";
    /*	Enter the password required to access the Server here, if you do not know this, contact your system admin or host provider */
    $base['DBPass'] = "dev";
    /*	Enter your Database name here, if you do not know this, contact your system admin or host provider */
    $base['DBSel'] = "technology_consult";
}
/**
**	Connect to the DB
**/

$setup = DB::dbSetup($base['DBSrv'], $base['DBUser'], $base['DBPass'], $base['DBSel']);

/**
**	Setup the Defaults from the DB (register) and pass into these variables
**/
$vars = DB::dbQuery("SELECT reg_param, reg_value FROM register ORDER BY reg_ID ASC;", "0");
while ($data = mysql_fetch_array($vars)) {
    define($data['reg_param'], $data['reg_value']);
}

?>
