<?php

require '../../class/class.database.php';

if ($_SERVER['HTTP_HOST'] != 'localhost') {
    DB::dbSetup('db1788.oneandone.co.uk', 'dbo276984790', 'xKdraC5G', 'db276984790');
} else {
    DB::dbSetup('localhost', 'chrisdev', 'xH/4N;lDK*dd', 'casacomplete');
}

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $update = DB::dbQuery("UPDATE bannerManager SET selected ='1' WHERE bannerID ='".$id."';","0");
    $update1 = DB::dbQuery("UPDATE bannerManager SET selected='0' WHERE bannerID != '".$id."';","0");
    if ($update) {
        if ($update1) {
            $return = "1";
        }
    }
} else {
    $return = "0";
}

echo $return;


?>
