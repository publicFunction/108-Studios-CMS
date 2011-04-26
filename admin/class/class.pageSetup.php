<?php

class pageSetup {
	
	public static function loadContent() {
			$getPage = mysql_query("SELECT pageContent FROM pagecontent WHERE pageID='".pageSetup::getPageID()."';");
			$showPage = mysql_fetch_array($getPage);
			return $showPage[0];
	}
	public static function loadPageHeader() {
		echo "The Pages main section is here";
	}
	
	public static function loadPageMenu() {
		$getMenu = DB::dbQuery("SELECT sitemenuName, sitemenuLink, sitemenuTitle sitemenuAlt, sitemenuImage FROM sitemenu ORDER BY sitemenuOrder ASC;", "0");
	}
	
	public static function loadPageHeadImg() {
		echo "<img src='imgs/mainLogo.png' alt='Main Site Logo' />";
	}

    public static function loadPageBackground() {
        $page = pageSetup::getPageID();
        $image = DB::dbQuery("SELECT mainImg FROM pagecontent WHERE pageID='".$page."';", "0");
        $img = DB::dbFetch($image, 'assoc');
        return UPLOAD_DIR."backgrounds/".$img['mainImg'];
	}

	public static function loadPageHeadImgAdmin() {
		echo "<img src='../".SITE_LOGO."' alt='".DEFAULT_TITLE." Logo' />";
	}
	
	public static function getTemplate() {
		$page = pageSetup::setPage();
		$getTem = mysql_query("SELECT pageTemplate FROM pageinfo WHERE pageName='".$page."';");
		$showTem = mysql_fetch_assoc($getTem);
        if (DB::dbCount($getTem) < 1) {
            return "blank.php";
        } else {
            return $showTem['pageTemplate'];
        }
	}
	
	public static function getPageID() {
		$page = pageSetup::setPage();
		$getID = mysql_query("SELECT id FROM pageinfo WHERE pageName='".$page."';");
		$theID = mysql_fetch_array($getID);
		return $theID['id'];
	}
	
	public static function loadTemplate($tmp) {
		require($tmp);
	}
	
	public static function setPage() {
		if (isset($_REQUEST['p'])) {
            if (strstr($_REQUEST['p'], ".")) {
                $page = explode(".", $_REQUEST['p']);
                $page = $page[0];
            } else {
                $page = $_REQUEST['p'];
            }
		} else {
			$page = 'index';
		}
		return $page;
	}
	
	public static function getTitle() {
		$page = pageSetup::setPage();
		$getPageSQL = mysql_query("SELECT * FROM pageinfo WHERE pageName='".$page."'");
		$pageInfo = mysql_fetch_assoc($getPageSQL);
		
		if (!$getPageSQL) {
			$msg = DEFAULT_TITLE;
			return $msg;
		} else {
			$msg = $pageInfo['pageTitle'];
			return $msg;
		}
	}
	
	public static function getMetaKey() {
		$page = pageSetup::setPage();
		$getPageSQL = mysql_query("SELECT * FROM pageinfo WHERE pageName='".$page."'");
		$pageInfo = mysql_fetch_assoc($getPageSQL);
		
		if (!$getPageSQL) {
			$msg = "Chris Moss @ Home108";
			return $msg;
		} else {
			$msg = $pageInfo['pageKey'];
			return $msg;
		}
	}
	
	public static function getMetaDesc() {
		$page = pageSetup::setPage();
		$getPageSQL = mysql_query("SELECT * FROM pageinfo WHERE pageName='".$page."'");
		$pageInfo = mysql_fetch_assoc($getPageSQL);
		
		if (!$getPageSQL) {
			$msg = "Chris Moss @ Home108";
			return $msg;
		} else {
			$msg = $pageInfo['pageDesc'];
			return $msg;
		}
	}
}

?>