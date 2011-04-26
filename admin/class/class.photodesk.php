<?php

class photodesk {

    public static function generatePhotoDesk($dir) {
        $featured = DB::dbQuery("SELECT image, text, link FROM calls_to_action WHERE featured='1';", "0");
        while($cta = DB::dbFetch($featured, 'assoc')) {
            $id = explode(".", $cta['link']);
            $id = $id[0];
            echo "  <div class='pd_photo'>
                        <div class='pd_hold'>
                            <img src='".$dir.$cta['image']."' alt='".$cta['image']."'/>
                        </div>
                        <span class='delete'></span>
                        <span class='content-text' id='".$id."'>".$cta['text']."</span>
                    </div>";
        }
    }

    public static function getPhotoDeskData() {
        $featured = DB::dbQuery("SELECT image, text, link FROM calls_to_action WHERE featured='1';", "0");
        $data = array();
        while($cta = DB::dbFetch($featured, 'assoc')) {
            array_push($data, $cta);
        }
        return $data;
    }


    public static function loading() {
        echo "  <div>
                    <a id='pd_loading' href='#' class='pd_loading'></a>
                </div>";
    }

    public static function runPhotoDesk() {
        echo "<script type='text/javascript' src='".INCLUDE_DIR."photodesk.js'></script>";
    }

}
?>
