<?php

// Set Include or Required Files Here Config is added by default, please add any other custom includes after this
require_once("config.php");

echo "
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	<html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta name='description' content='".pageSetup::getMetaDesc()."' />
	<meta name='keywords' content='".pageSetup::getMetaKey()."' />";
    settings::loadjQuery('1.4.4');
    settings::loadjQueryUI('1.8.9');
    settings::loadInclude('js');
echo "
    <link href='http://fonts.googleapis.com/css?family=Just+Me+Again+Down+Here' rel='stylesheet' type='text/css' />
    <link href='css/photodesk.css' rel='stylesheet' type='text.css' />
	<link href='css/cms.css' rel='stylesheet' type='text/css' />
    <link rel='shortcut icon' href='favicon.png' />
    <title>".pageSetup::getTitle()."</title>
	</head>
	<body>";
?>
