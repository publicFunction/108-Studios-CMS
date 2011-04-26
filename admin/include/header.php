<?php
session_start();
// Set Include or Required Files Here Config is added by default, please add any other custom includes after this
require("include/config.php");
settings::loadRegistry();
//pageSetup::findPage($_SERVER['SCRIPT_NAME']);
pageSetup::setPage();
echo "
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	<html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
	<title>".DEFAULT_ADMIN_TITLE."</title>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<link href='css/admincms.css' rel='stylesheet' type='text/css' />";
    settings::loadjQuery('1.4.4');
    settings::loadjQueryUI('1.8.9');
echo "
    <script type='text/javascript' src='include/tiny_mce/tiny_mce.js'></script>
    <script type='text/javascript' src='include/js/jqueryActions.js'></script>
	</head>
	<body>";
?>
