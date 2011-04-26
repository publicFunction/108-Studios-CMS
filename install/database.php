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
            <li class="active"><a href="database.php">Database</a></li>
            <li><a href="register.php">Registry</a></li>
		</ul>
	</div>
	<div id="content-wrap">
        <div id="content">
            <div id="database">
                <h1>Database Setup</h1>
                <p>
                    Ok&hellip; Lets get the DB setup&hellip;<br />
                    Setting up the DB should have been already done by you, editing the 
                    include/config.php file. If you are seeing this page and you have not
                    edited the include/config.php file, then something has gone wrong and
                    you need to report it to me via the email address in the start tab.
                    Hopefully you have and we can run the checks&hellip;
                </p>
                <p>First item on the to do list is to check the site config file.</p>
                <h4>Checking the Site Configuration File&hellip;</h4>
                <div class="codeblock">
                    <?php
                        $main = file($mainConf);
                        $good = true;
                        $dbArray = array();
                        foreach($main as $lineNum=>$line) {
                            if (strstr($line,"\$base['DB") && !strstr($line, "\$setup")) {
                                $data = explode("=",$line);
                                $data = trim($data[1]);
                                $data = str_replace("\"","", str_replace(";","", $data));
                                array_push($dbArray, $data);
                                if ($data == "" || $data == null) {
                                    $good = false;
                                    $badLine = $lineNum." ".$line;
                                }
                            }
                        }
                        if ($good) {
                            echo "  The ".$mainConf." Configuration File is completed&hellip;<br />
                                    Testing Connectivity&hellip;<br />";
                            $conn = mysql_connect($dbArray[0], $dbArray[1], $dbArray[2]);
                            if(!$conn) {
                                echo "  We are unable to connect to the database server please confirm the settings&hellip<br />";
                            } else {
                                echo "  Connected and attempting to access the database&hellip;<br />";
                                $db = mysql_select_db($dbArray[3]);
                                if(!$db) {
                                    echo "  Access to the database has failed, please check this setting&hellip;";
                                } else {
                                    echo "  Access Test Completed&hellip;<br />
                                            Testing Read Access...<br />";
                                    $test = mysql_query("SELECT reg_value FROM register WHERE reg_param='DEFAULT_TITLE';");
                                    $testRead = mysql_fetch_assoc($test);
                                    if ($testRead['reg_value'] == "" || $testRead['reg_value'] == null) {
                                        echo "  Read Access Failed&hellip;<br />
                                                Please have your server admin check your database permissions&hellip;";
                                    } else {
                                        echo "  Read Access Successfull&hellip;<br />
                                                Testing Write/Delete Access&hellip;<br />";
                                        $test = mysql_query("INSERT INTO register VALUES ('','DB_WRITE_TEST','db write test. if still in register table, please delete this','System','db write test. if still in register table, please delete this');");
                                        $test = mysql_query("SELECT reg_value FROM register WHERE reg_param='DB_WRITE_TEST';");
                                        $testWrite = mysql_fetch_array($test);
                                        if ($testWrite['reg_value'] != "" || $testWrite['reg_value'] != null) {
                                            echo "  Write Access Successfull&hellip;<br />
                                                    Testing Delete Access&hellip;<br />";
                                            $test = mysql_query("DELETE FROM register WHERE reg_param='DB_WRITE_TEST';");
                                            $test = mysql_query("SELECT reg_value FROM register WHERE reg_param='DB_WRITE_TEST';");
                                            $testDelete = mysql_fetch_array($test);
                                            if ($testDelete['reg_value'] == "" || $testDelete['reg_value'] == null) {
                                                echo "  Delete Access Successfull&hellip;<br />
                                                        Your DB testing is completed and you are ready to proceed.";
                                            } else {
                                                echo "  Delete Access Failed&hellip;<br />
                                                        Please have your server admin check your database permissions&hellip;";
                                            }
                                        } else {
                                            echo "  Write Access Failed&hellip;<br />
                                                    Please have your server admin check your database permissions&hellip;";
                                        }
                                    }
                                }
                            }
                        } else {
                            echo "  INSTALL ERROR AT LINE #".$badLine."<br />
                                    PLEASE INSERT THE REQUIRED DATA";
                        }
                    ?>
                </div>
                <p>Please ensure that the database information is the same in Admin Configuration File as it is in the Site Configuration File</p>
                <p><a href="register.php">Click here</a> or click the Register Tab to Finish the install</p>
            </div>
		</div>
	</div>
</div>
<?php
require_once('include/footer.php');
?>
