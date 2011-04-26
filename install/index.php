<?php
require_once('include/header.php');

$mainConf = "../include/config.php";
$adminConf = "../admin/include/config.php";
if(isset($_REQUEST['stat'])) {
    $start = false;
    switch($_REQUEST['stat']){
        case "SETUPDB":
            echo "<p>YOU APPEAR NOT TO HAVE SET UP A DATABASE. PLEASE SEE YOUR ADMINISTRATOR ABOUT SETTING ONE UP</p>";
            die();
            break;
        case "INSTALL":
            echo "<p>YOU APPEAR TO HAVE SET UP A DATABASE, BUT THE DEFAULT DATA HAS NOT BEEN INSTALLED. PLEASE SEE YOUR ADMINISTRATOR ABOUT INSERTING THE DATA</p>";
            die();
            break;
        default:
            echo "<p>MANIPULATION OF THE URL WILL RESULT IN AN INSTALLION FAILURE.</p>";
            die();
            break;
    }
} else {
    $start = true;
}
?>
<div id="wrap">
	<div id="header">
		<div id="site-name">108 Skeleton CMS Install</div>
		<ul id="nav">
            <li id="home-tab" class="active"><a href="./" id="load-start">Start</a></li>
            <li><a href="database.php">Database</a></li>
            <li><a href="register.php">Registry</a></li>
		</ul>
	</div>
	<div id="content-wrap">
        <div id="content">
            <div id="start">
            <h1>Installation</h1>
            <?php
            if(!$start) {
            ?>
            <p>
                We have attempted to contact your database so we can proceed with the
                installation. This has not worked and it means that we need you to setup your
                database. So, you need to go back and create a new database on your mySQL
                Database Server. Once you have done that you are required to edit the config
                files that control this access into the system and make the CMS work. Don't
                panic the config files are fully commented with the data you need to put
                where and should take seconds to do.
            </p>
            <p>
                The files that need editing are found at <small><em>(from the installation root)</em></small>:
                <ul>
                    <li>include/config.php</li>
                    <li>admin/include/config.php</li>
                </ul>
                These files must be edited prior to the site being able to function.
            </p>
            <?php
            } else {
            ?>
            <p>
                You have already extracted the zip file contents and edited the config files
                so we need to get to grips and get the base of the site up and running and
                off this really annoying nag install screen.
            </p>
            <p>
                You have 2 choices, manually set it up or follow the tabs to install it bit
                by bit. Manual install instructions are simple to follow and can be found
                at:
            </p>
            <ul>
                <li>The place I put them when I write them lol. In the meantime email me at info@108-studios.co.uk</li>
            </ul>
            <p>
                As this is an alpha I will be updating it as and when I see fit (actually
                that should say "can be arsed", as I do this for a living), but you can't
                swear on the Internet. Can you?
            </p>
            <p>
                Anyway enough claptrap, here is some info.
            </p>
            <p>
                If you wish to keep up the Alpha to its current standard, then please get 
                the current code from SVN at:
            </p>
            <ul>
                <li>svn://svn.108-studios.co.uk/skeletoncms/</li>
            </ul>
            <p>
                If you find any bugs, feature additions to be put into the base of the CMS or
                any tweaks to the code then add them at the bugs site at:
            </p>
            <ul>
                <li>The place I put them when I can find a good and easy to use bug tracker
                    that will integrate with Subversion (I know there are a few). In the
                    meantime email me at info@108-studios.co.uk</li>
            </ul>
            <p>
                Read only access is also available, <em>for the time being</em>, through
                WebSvn at:
            </p>
            <ul>
                <li><a href="http://svn.108-studios.co.uk/websvn/listing.php?repname=skeletoncms&path=%2F&sc=0">This Link :P</a></li>
            </ul>
            </div>
            <?php
            }
            ?>
		</div>
	</div>
</div>
<?php
require_once('include/footer.php');
?>
