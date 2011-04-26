<?php

class error {

      public static function displayError($id) {
        /*
         *  1n = DB Errors
         *  2n = Another Error
         *  3n = More space for errors
         *  4n = Yes you guessed it more arror code room
         *  5n = Image Handle errors
         */
        switch ($id) {
            case "10":
                echo "<p class='error'>There was an error with your SQL Query.</p>";
                break;
            case "11":
                echo "<p class='error'>There was an error with your SQL Fetch.</p>";
                break;
            case "12":
                echo "<p class='error'>There was an error with your SQL Update.</p>";
                break;
            case "13":
                echo "<p class='error'>There was an error with your SQL Delete.</p>";
                break;
            case "14":
                echo "<p class='error'>There was an error with your SQL Insert.</p>";
                break;
            case "51":
                echo "<p class='error'>The image you chose was not a valid image extension, please ensure your images are jpg (jpeg).</p>";
                default;
            case "52":
                echo "<p class='error'>The file failed to upload to the server.</p>";
                default;
            case "53":
                echo "<p class='error'>The file name already exists on the server, please choose another file to upload.</p>";
                default;
            default:
                break;
        }
    }

}

?>
