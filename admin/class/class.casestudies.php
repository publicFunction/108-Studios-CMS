<?php

class CaseStudy {

    public static function listCaseStudies($type) {
        
        switch($type) {
            case "web":
                $list = DB::dbQuery("SELECT websites.id, websites.name, websites.page, websites.group_id, website_groups.groups FROM websites INNER JOIN website_groups WHERE websites.group_id=website_groups.id ORDER BY websites.id ASC;", "0");
                $image = "icons/browsers.png";
                break;
            case "app":
                $list = DB::dbQuery("SELECT apps.id, apps.name, apps.page, apps.group_id, app_groups.groups FROM apps INNER JOIN app_groups WHERE apps.group_id=app_groups.id ORDER BY apps.id ASC;", "0");
                $image = "icons/mobile_apps.png";
                break;
            default:
                break;
        }
        echo "  <p>
                    <a href='login.php?do=".$type."&amp;action=add' title='Add new Item'>Add New ".ucfirst($type)." Item</a> | 
                    <a href='login.php?do=group&amp;action=add&amp;item=".$type."' title='Add New Group'>Add A New Group for ".ucfirst($type)."</a>
                </p>";
        while($item = DB::dbFetch($list, 'assoc')) {
            echo "  <div class='holder'>
                        <div class='newsIcon'>
                            <a href='?do=".$type."&amp;action=edit&amp;item=".$item['id']."' title='Edit ".$type." item'>
                                <img src='".$image."' alt='News icon' />
                            </a>
                        </div>
                        <div class='newsTitle'>".actions::shortenText($item['name'], 0, 10, true)."</div>
                    </div>";
        }

    }

    public static function editCaseStudy($id, $type) {
        switch ($type) {
            case "web":
                $groups = self::getWebsiteGroups();
                break;
            case "app":
                $groups = self::getAppGroups();
                break;
            default:
                break;
        }
        if(isset($_REQUEST['saveCase'])) {
            $data = array(  'name' => $_REQUEST['caseName'],
                            'page' => $_REQUEST['pageURL'],
                            'group_id' => $_REQUEST['groupID']
                        );
            self::saveCase($data, $type, $id);
        } else {
            $study = self::getCase($id, $type);
            $pages = actions::getPages();
            forms::openForm('createCase', 'createCase', 'login.php?do='.$type.'&amp;action=edit&amp;item='.$id.'', 'POST');
            forms::fieldsetOpen('Editing a New '.ucfirst($type).' Item');
            forms::input('caseName', 'caseName', $study['name'], '', 'Name: ', 'text');
            forms::select('pageURL', 'pageURL', $pages, '', '', 'Page URL: ', $study['page']);
            forms::select('groupID', 'groupID', $groups, '', '', 'Group: ', $study['group_id']);
            forms::input('saveCase', 'saveCase', 'Save', '', '&nbsp;', 'submit');
            forms::fieldsetClose();
            forms::closeForm();
        }
    }

    public static function addCaseStudy($type) {
        switch ($type) {
            case "web":
                $groups = self::getWebsiteGroups();
                break;
            case "app":
                $groups = self::getAppGroups();
                break;
            default:
                break;
        }
        if(isset($_REQUEST['saveCase'])) {
            $data = array(  'name' => $_REQUEST['caseName'],
                            'page' => $_REQUEST['pageURL'],
                            'group_id' => $_REQUEST['groupID']
                        );
            self::saveCase($data, $type, 'save');
        } else {
            $pages = actions::getPages();
            forms::openForm('createCase', 'createCase', 'login.php?do='.$type.'&amp;action=add', 'POST');
            forms::fieldsetOpen('Add a New '.ucfirst($type).' Item');
            forms::input('caseName', 'caseName', '', '', 'Name: ', 'text');
            forms::select('pageURL', 'pageURL', $pages, '', '', 'Page URL: ');
            forms::select('groupID', 'groupID', $groups, '', '', 'Group: ');
            forms::input('saveCase', 'saveCase', 'Save', '', '&nbsp;', 'submit');
            forms::fieldsetClose();
            forms::closeForm();
        }
    }

    private static function getCase($id, $type) {
        switch ($type) {
            case "web":
                $data = DB::dbQuery("SELECT * FROM websites WHERE id='".$id."';", "0");
                break;
            case "app":
                $data = DB::dbQuery("SELECT * FROM apps WHERE id='".$id."';", "0");
                break;
            default:
                break;
        }
        while($item = DB::dbFetch($data, 'assoc')) {
            $case = array(  'name' => $item['name'],
                            'page' => $item['page'],
                            'group_id' => $item['group_id']
                        );
        }
        return $case;
    }

    private static function saveCase($data, $type, $id) {
        $id = intval($id);
        if (is_integer($id)&& $id >= "1") {
            switch ($type) {
                case "web":
                    DB::dbUpdate('websites', $data, "id='".$id."'");
                    break;
                case "app":
                    DB::dbUpdate('apps', $data, "id='".$id."'");
                    break;
                default:
                    break;
            }
        } else {
            switch ($type) {
                case "web":
                    DB::dbInsert('websites', $data);
                    break;
                case "app":
                    DB::dbInsert('apps', $data);
                    break;
                default:
                    break;
            }
        }
        echo "  <p>New ".ucfirst($type)." Item Saved&hellip;</p>
                <p><a href='?do=".$type."' title='Back to the list'>Return</a></p>";
    }

    public static function addGroup($type) {
        if (isset($_REQUEST['saveGroup'])) {
            $data = array(  'groups' => $_REQUEST['groupName']);
            switch($type) {
                case "web":
                    DB::dbInsert('website_groups', $data);
                    break;
                case "app":
                    DB::dbInsert('app_groups', $data);
                    break;
                default:
                    break;
            }
            echo "  <p>New ".ucfirst($type)." Saved&hellip;</p>
                    <p><a href='login.php?do=group&amp;action=add&amp;item=".$type."' title='Add Another'>Add Another</a></p>
                    <p><a href='?do=pages' title='Back to the page list'>Return</a></p>";
        } else {
            forms::openForm('createGroup', 'createGroup', 'login.php?do=group&action=add&amp;item='.$type, 'POST');
            forms::fieldsetOpen("Add a New Group to ".ucfirst($type)." Groups");
            forms::input('groupName', 'groupName', '', '', 'Group Name: ', 'text');
            forms::input('saveGroup', 'saveGroup', 'Save', '', '&nbsp;', 'submit');
            forms::fieldsetClose();
            forms::closeForm();
        }
    }

    public static function showTitle() {
        $page = pageSetup::getPageID();
        $title = DB::dbQuery("SELECT pageTitle FROM pageinfo WHERE id='".$page."';", "1");
        return $title;
    }

    private static function getWebsiteGroups(){
        $groups = DB::dbQuery("SELECT * FROM website_groups ORDER BY id ASC;", "0");
        while ($group = DB::dbFetch($groups, 'assoc')) {
            $groupList[$group['id']] = $group['groups'];
        }
        return $groupList;
    }

    private static function getWebsites() {
        $groups = self::getWebsiteGroups();
        $output = "";
        foreach($groups as $key=>$val) {
            $output .= "<div class='listHolder'>";
            $output .= "<h4>".$val."</h4>";
            $output .= self::siteData($key,'web');
            $output .= "</div>";
        }
        return $output;
    }

    private static function siteData($group, $type) {
        switch($type) {
            case "web":
                $site = DB::dbQuery("SELECT * FROM websites WHERE group_id='".$group."';", "0");
                break;
            case "app":
                $site = DB::dbQuery("SELECT * FROM apps WHERE group_id='".$group."';", "0");
                break;
            default:
                break;
        }
        $data = "";
        while($siteData = DB::dbFetch($site, "assoc")) {
            $elID = explode(".",$siteData['page']);
            $elID = $elID[0];
            $data .= "  <div class='list'>
                            <a id='".$elID."' href='".$siteData['page']."' title='".$siteData['name']."'>".$siteData['name']."</a>
                        </div>";
        }
        return $data;
    }

    private static function appData($group) {
        $site = DB::dbQuery("SELECT * FROM websites WHERE group_id='".$group."';", "0");
        $data = "";
        while($siteData = DB::dbFetch($site, "assoc")) {
            $data .= "<div class='list'>".$siteData['name']."</div>";
        }
        return $data;
    }

    private static function getAppGroups(){
        $groups = DB::dbQuery("SELECT * FROM app_groups ORDER BY id ASC;", "0");
        while ($group = DB::dbFetch($groups, 'assoc')) {
            $groupList[$group['id']] = $group['groups'];
        }
        return $groupList;
    }

    private static function getApps() {
        $groups = self::getAppGroups();
        $output = "";
        foreach($groups as $key=>$val) {
           $output .= "<div class='listHolder'>";
            $output .= "<h4>".$val."</h4>";
            $output .= self::siteData($key, 'app');
            $output .= "</div>";
        }
        return $output;
    }

    public static function showWebsites() {
        return self::getWebsites();
    }

    public static function showApps() {
        return self::getApps();
    }
}
?>
