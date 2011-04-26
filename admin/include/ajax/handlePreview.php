<?php
require_once('ajaxconfig.php');

if (isset($_REQUEST['type'])) {
    if ($_REQUEST['image'] != "0") {
        switch($_REQUEST['type']) {
            case "image":
                echo "<img src='../".UPLOAD_DIR."images/".$_REQUEST['image']."' alt='".$_REQUEST['image']."' />";
                break;
            case "ctaImage":
                echo "<img src='../".UPLOAD_DIR."polaroids/".$_REQUEST['image']."' alt='".$_REQUEST['image']."' />";
                break;
            case "mainImg":
                echo "<img src='../".UPLOAD_DIR."backgrounds/".$_REQUEST['image']."' alt='".$_REQUEST['image']."' />";
                break;
            default:
                echo "<img src='../".UPLOAD_DIR."tclogo.jpg' alt='TC Logo' />";
                break;
        }
    } else {
        echo "<img src='../".UPLOAD_DIR."images/tclogo.jpg' alt='TC Logo' />";
    }
} else {
    echo "<img src='../".UPLOAD_DIR."images/tclogo.jpg' alt='TC Logo' />";
}

?>