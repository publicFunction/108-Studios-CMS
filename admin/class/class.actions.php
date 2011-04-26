<?php

class actions {

    public static function pageExists($page) {
        $check = DB::dbQuery("SELECT id FROM pageinfo WHERE pageName='".$page."'", "1");
		
        if ($check != "") {
            return false;
        } else {
            return true;
        }
    }

    public static function getImages($dir) {
        $directory = opendir($dir);
        if ($directory) {
            while (($file = readdir($directory)) !== false) {
                if ($file != "." && $file != ".." && $file != ".svn") {
                    $images[$file] = $file;
                }
            }
        }
        if (empty($images)) {
            return $images[0] = "None";
        } else {
            return $images;
        }
    }

    public static function getPages() {
        $pageList = DB::dbQuery("SELECT pageURL FROM pageinfo ORDER BY id ASC;", "0");
        while($page = DB::dbFetch($pageList, 'assoc')) {
            $pages[$page['pageURL']] = $page['pageURL'];
        }
        return $pages;
    }

    public static function getTemplates($dir) {
        $templates[0] = 'New';
        $directory = opendir($dir);
        if ($directory) {
            while (($file = readdir($directory)) !== false) {
                if ($file != "." && $file != ".." && $file != ".svn") {
                    $templates[$file] = $file;
                }
            }
        }
        return $templates;
    }

    public static function createTemplate($file) {
        $file = $file.".php";
        $createFile = fopen("../".TEMPLATE_DIR.$file, 'w');
        $output = "<div id=\"page-content\">\n\n\t<?php\n\n\techo stripslashes(pageSetup::loadContent());\n\n\t?></div>";
        fwrite($createFile, $output);
        fclose($createFile);
        return "<p>Template Page Created.</p>";
    }


    public static function md5Pass($password) {
        $pass = base64_encode($password);
        return $pass;
    }

    public static function unmd5Pass($password) {
        $pass = base64_decode($password);
        return $pass;
    }

    public static function reverseDate($date) {
		if (strpos($date, " ") > 1) {
			$getTime = explode(" ", $date);
			$getDate = explode("-", $date);
			$fixedDate = substr($getDate[2], 0, 2)."-".$getDate[1]."-".$getDate[0]." ".$getTime[1];
		} else {
			$getDate = explode("-", $date);
			$fixedDate = $getDate[2]."-".$getDate[1]."-".$getDate[0];
		}
		return $fixedDate;
	}

    public static function prettyDate($date) {
        //$date = str_replace("-", " ", $date);
        $date = explode("-", $date);
        $date = $date[0]." ".date('M', strtotime($date[2]."-".$date[1]."-".$date[0]))." ".$date[2];
        return $date;
    }

    public static function dbSafeDate($date) {
		if (strpos($date, " ") > 1) {
			$getTime = explode(" ", $date);
			$getDate = explode("-", $date);
			$fixedDate = substr($getDate[2], 0, 2)."-".$getDate[1]."-".$getDate[0]." ".$getTime[1];
		} else {
			$getDate = explode("-", $date);
			$fixedDate = $getDate[2]."-".$getDate[1]."-".$getDate[0];
		}
		return $fixedDate;
	}

    public static function createPassword($limit, $strength) {
        $vowels = 'aeiou';
        $consonants = 'bcdfghjklmnpqrstvwxyz';
        if ($strength & 1) {
            $consonants .= 'BCDFGHJJKLMNPQRSTVWXYZ';
        }
        if ($strength & 2) {
            $vowels .= "AEIOU";
        }
        if ($strength & 4) {
            $consonants .= '0123456789';
        }
        if ($strength & 8) {
            $consonants .= '@#$%';
        }
        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $limit; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }

    public static function clearArray($arr) {
        if (is_array($arr)) {
                unset($arr);
        } else {
                echo "<p>There was an issue with removing stored data when saving the page. Please contact your site admin.</p>";
        }
    }
	
    public static function shortenText($text, $start, $length, $dots) {
        if (strlen($text) > $length) {
            if ($dots) {
                $text = substr($text, $start, $length-3);
                $text = $text."&hellip;";
                return $text;
            } else {
                return $text;
            }
        } else {
            return $text;
        }
    }
	
    public static function returnToHome() {
        echo "<p>Display the admin main homepage content</p>";
    }

    public static function showLinks() {
        // Display the Links Admin Page and List the current links
        echo "<a href='?action=newLink' class='buttonMove'><button class='submit'>Add</button></a> ";
        echo "<a href='?action=removeLink' class='buttonMove'><button class='submit'>Remove</button></a> ";
        echo "<a href='?action=updateLink' class='buttonMove'><button class='submit'>Update</button></a> ";
        echo "<hr />";
        echo "<p>Please select an option from above:</p>";
        $getLinks = mysql_query("SELECT * FROM links ORDER BY linkID ASC");

        while ($link=mysql_fetch_assoc($getLinks)) {
                echo "<span id='linkName'>".$link['linkName']."</span><span id='seperator'> > </span><span id='linkTitle'>".$link['linkTitle']."</span><br />";
        }
    }

    public static function listLinks() {
        echo "<a href='/admin/login.php?action=newLink' class='buttonMove'><button class='submit'>Add</button></a> ";
        echo "<a href='/admin/login.php?action=removeLink' class='buttonMove'><button class='submit'>Remove</button></a> ";
        echo "<a href='/admin/login.php?action=updateLink' class='buttonMove'><button class='submit'>Update</button></a> ";
        echo "<hr />";
        echo "<p>Please complete the form below to add a new link:</p>";
        echo "<fieldset>
                <form action='".$postBack."?action=newLink&do=add' name='addLinks' method='post'>
                    <ol><label>Link Name: </label><input type='text' name='linkName' /><span class='explan'>name to appear on the links list</span></ol>
                    <ol><label>Link Title: </label><input type='text' name='linkTitle' /><span class='explan'>text to appear in title section of the tag</span></ol>
                    <ol><label>Link Location: </label><input type='text' name='linkLoc' /><span class='explan'>full url of the link</span></ol>
                    <ol><label>Link Alt Text: </label><input type='text' name='linkAlt' /><span class='explan'>alt link text (for accessability compliance)</span></ol>
                    <ol><input type='hidden' name='linkImg' value='To Be Implimented' /></ol>
                    <ol><input class='submit' type='submit' name='linkAdd' value='Add' /></ol>
                </form>
            </fieldset>";
        if ($_REQUEST['do'] == "add") {
            echo "<p>Creating a New Link for the Links Page</p>";
            if (isset($_REQUEST['linkAdd'])){
                echo "<p>Adding the New Link...</p>";
                $addLink = mysql_query("INSERT INTO links
                                        (linkName, linkTitle, linkActual, linkAlt, linkImg)
                                        VALUES
                                        ('".$_REQUEST['linkName']."','".$_REQUEST['linkTitle']."','".$_REQUEST['linkLoc']."','".$_REQUEST['linkAlt']."','".$_REQUEST['linkImg']."')");
                if (!$addLink) {
                    echo "<p>New Link Failed to Update. ".mysql_error()."</p>";
                } else {
                    echo "<p>New Link Added</p>";
                }
            }
        }
    }

}

?>