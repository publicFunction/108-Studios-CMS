<?php

class menus {

    public static function pageMenuOptions() {
        $options = array(   '0' => 'None',
                            '1' => 'Main Menu',
                            '2' => 'Footer'
                        );
        return $options;
    }

    public static function listMenu() {
        
    }

    //	Sets up the correct menu for the relevant page
    public static function menuLinks($menuType, $seperator=false) {
        switch ($menuType) {
            //	MAIN Menu
            case "default":
                $topMenu = DB::dbQuery("SELECT sitemenuName, sitemenuLink, sitemenuTitle, siteLinkPop, sitemenuAlt, sitemenuImage FROM sitemenu WHERE sitemenuLoc='0' ORDER BY sitemenuOrder ASC;", "0");
                echo "<ul>";
                while ($hpLink = mysql_fetch_assoc($topMenu)) {
                    echo "  <li><a href='".$hpLink['sitemenuLink']."' title='".$hpLink['sitemenuTitle']."'>";
                    if ($hpLink['sitemenuImage'] == "" || $hpLink['sitemenuImage'] == null) {
                        echo $hpLink['sitemenuTitle'];
                    } else {
                        echo "<li><img src='imgs/".$hpLink['sitemenuImage']."' alt='".$hpLink['sitemenuAlt']."' />";
                    }
					echo "  </a></li>";
                }
                echo "</ul>";
                break;
            // ADMIN Menu
            case "admin":
				if (admin::chkExtendedRights()) {
                    $admin = DB::dbQuery("SELECT adminmenuName, adminmenuLink, adminMenuTitle, adminLinkPop, adminmenuImage, adminmenuAlt FROM adminmenu ORDER BY adminmenuOrder ASC;", "0");
                } else {
                    $admin = DB::dbQuery("SELECT adminmenuName, adminmenuLink, adminMenuTitle, adminLinkPop, adminmenuImage, adminmenuAlt FROM adminmenu WHERE adminmenuAccess = '0' ORDER BY adminmenuOrder ASC;", "0");
                }
                while ($adminLink = mysql_fetch_assoc($admin)) {
                        echo "<div class='linkHolder'>";
                        if ($adminLink['adminLinkPop'] == "1") {
                            echo "<a href='".$adminLink['adminmenuLink']."' target='_blank' ";
                        } else {
                            echo "<a href='login.php".$adminLink['adminmenuLink']."' ";
                        }
                        echo " title='".$adminLink['adminMenuTitle']."'>";
                        if ($adminLink['adminmenuImage'] != "") {
                            echo "<img src='".$adminLink['adminmenuImage']."' alt='".$adminLink['adminmenuAlt']."' />";
                            echo $adminLink['adminmenuName'];
                        } else {
                            echo $adminLink['adminmenuName'];
                        }
                        echo "</a>
                            </div>";
                    }
				
                break;
			case "footer":
				$footerMenu = DB::dbQuery("SELECT menuName, menuLink, menuTitle, menuImage, linkPop, menuAlt FROM footermenu ORDER BY menuID ASC;", "0");
                while ($hpLink = mysql_fetch_assoc($footerMenu)) {
					echo "<a href='".$hpLink['menuLink']."' title='".$hpLink['menuTitle']."'>";
                    if ($hpLink['menuImage'] == "" || $hpLink['menuImage'] == null) {
                        echo $hpLink['menuName'];
                    } else {
                        echo "<img src='imgs/".$hpLink['menuImage']."' alt='".$hpLink['menuAlt']."' />";
                    }
                    if ($seperator) {
                        echo " ".$seperator. " ";
                    }
                    echo "</a>";
                }
				break;
            case "socialmedia":
                echo socialmedia::facebookLink(FACEBOOK_PAGE);
                echo socialmedia::twitterLink(TWITTER_PAGE);
                echo socialmedia::linkedinLink(LINKEDIN_PAGE);
                break;
            default:
                break;
        }
    }
}
?>