<?php
/* This is where you would inject your sql into the database
   but we're just going to format it and send it back
*/

require '../../class/class.database.php';

if ($_SERVER['HTTP_HOST'] != 'localhost') {
    DB::dbSetup('db1788.oneandone.co.uk', 'dbo276984790', 'xKdraC5G', 'db276984790');
} else {
    DB::dbSetup('localhost', 'chrisdev', 'xH/4N;lDK*dd', 'casacomplete');
}



$return = "0";
foreach ($_GET['listItem'] as $position => $item) {
    $position = $position+1;
    $q = DB::dbQuery("UPDATE main_property SET displayOrder = '".$position."' WHERE property_id ='". $item."';","0");
    if (!$q) {
        $return = "0";
    } else {
        $return = "1";
    }
}

echo $return;

?>