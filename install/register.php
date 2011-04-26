<?php
require_once('include/header.php');

$mainConf = "../include/config.php";
$adminConf = "../admin/include/config.php";

?>

<div id="wrap">
	<div id="header">
		<div id="site-name">108 Skeleton CMS Install</div>
		<ul id="nav">
            <li id="home-tab"><a href="./">Start</a></li>
            <li><a href="database.php">Database</a></li>
            <li class="active"><a href="register.php">Registry</a></li>
		</ul>
	</div>
	<div id="content-wrap">
        <div id="content">
            <div id="registry">
                <h1>Register Setup</h1>
            </div>
		</div>
	</div>
</div>
<?php
require_once('include/footer.php');
?>
