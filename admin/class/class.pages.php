<?php

class pages {
    
    public static function addPage() {
        if (isset($_REQUEST['savePage'])) {
            $form = array();
            foreach ($_REQUEST as $key=>$val) {
                $form[$key] = $val;
            }
            pages::savePage($form, 'new', '');
        } else {
            $templates = actions::getTemplates("../".TEMPLATE_DIR);
            $menuOptions = menus::pageMenuOptions();
            $pageImages = actions::getImages("../".UPLOAD_DIR."backgrounds/");
            admin::setupRichEdit();
            forms::openForm('addPage', 'addPage', 'login.php?do=pages&amp;action=add', 'POST');
            forms::fieldsetOpen('Add a New Page');
            forms::input('pageName', 'pageName', 'index', '', '', 'hidden');
            forms::input('pageTitle', 'pageTitle', '', '', 'Page Title: ', 'text');
            forms::textarea('pageKey', 'pageKey', '', '', 'Keywords: ', '1', '1');
            forms::textarea('pageDesc', 'pageDesc', '', '', 'Description: ', '1', '1');
            forms::select('mainImg', 'selectedImage', $pageImages, '', '', 'Page Background: ');
            echo "<div id='preview'></div>";
            forms::input('pageURL', 'pageURL', '', '', 'Page URL: ', 'text');
            forms::input('pageType', 'pageType', '', '', 'Page Type (alias): ', 'text');
            forms::select('pageTemplate', 'pageTemplate', $templates, '', '', 'Page Template: ');
            forms::select('pageMenu', 'pagemenu', $menuOptions, '', '', 'Add to Menu: ');
            forms::input('pageHC', 'pageHC', '', '', 'Page Hardcoded: ', 'checkbox');
            forms::textarea('pageContent', 'pageContent', '', 'richEdit', 'Content: ', '1', '1');
            /*forms::input('tinyOff', 'tinyOff', '', '', 'Turn Off Tiny: ', 'checkbox');*/
            forms::input('pageComment', 'pageComment', '', '', 'Page Comment: ', 'text');
            forms::input('savePage', 'savePage', 'Save', '', '&nbsp;', 'submit');
            forms::fieldsetClose();
            forms::closeForm();
        }
    }


    public static function listPages() {
		echo "<div class='pageContainer'>
                <h3>Page Content Manager</h3>
                <p>
                    <span>Add a new page</span>
                    <a href='login.php?do=pages&amp;action=add' title='Add a New Page'>
                        <img src='icons/add_page.png' alt='Add Page' />
                    </a>
                </p>
                <p>Select a page to edit</p>";
		$getPages = DB::dbQuery("SELECT * FROM pagecontent ORDER BY id ASC;", "0", "");
		while ($pageList = mysql_fetch_assoc($getPages)) {
			echo "<div class='pageHolder'>";
			echo "<a href='?do=pages&action=edit&page=".$pageList['id']."' title='".$pageList['pageComment']."'>";
			echo "<img src='icons/text_page.png' alt='Edit the ".$pageList['pageComment']." page' />";
			echo "</a>";
			echo actions::shortenText($pageList['pageComment'], '0', 12, true);
			echo "</div>";
		}
		echo "</div>";
    }

    public static function editPage($p) {
		if (isset($_REQUEST['savePage'])) {
			$form = array();
			foreach ($_REQUEST as $key=>$val) {
				$form[$key] = $val;
			}
			self::savePage($form,'update', $p);
		} else {
			$getPage = DB::dbQuery("SELECT pageinfo.pageName, pageinfo.pageTitle, pageinfo.pageKey, pageinfo.pageDesc, pageinfo.pageTemplate, pageinfo.pageHC, pageinfo.pageURL, pageinfo.pageType, pagecontent.pageContent, pagecontent.pageVersion, pagecontent.pageComment, pagecontent.pageHeader, pagecontent.mainImg FROM pageinfo INNER JOIN pagecontent WHERE pageinfo.id = pagecontent.pageID AND pageinfo.id = '".$p."';", "0");
			while ($page = DB::dbFetch($getPage, "assoc")) {
                $templates = actions::getTemplates("../".TEMPLATE_DIR);
                $menuOptions = menus::pageMenuOptions();
                $pageImages = actions::getImages("../".UPLOAD_DIR."backgrounds/");
                forms::openForm('addPage', 'addPage', 'login.php?do=pages&amp;action=edit&amp;page='.$p.'', 'post');
                forms::fieldsetOpen("Editing the ".$page['pageComment']);
                forms::input('pageID', 'pageID', $p, '', '', 'hidden');
                forms::input('pageName', 'pageName', $page['pageName'], '', '', 'hidden');
                forms::input('pageTitle', 'pageTitle', $page['pageTitle'], '', 'Page Title: ', 'text');
                forms::textarea('pageKey', 'pageKey', $page['pageKey'], '', 'Keywords: ', '1', '1');
                forms::textarea('pageDesc', 'pageDesc', $page['pageDesc'], '', 'Description: ', '1', '1');
                forms::select('mainImg', 'selectedImage', $pageImages, 'None', '0', 'Page Background: ',$page['mainImg']);
                echo "<div id='preview'></div>";
                forms::input('pageURL', 'pageURL', $page['pageURL'], '', 'Page URL: ', 'text');
                forms::input('pageType', 'pageType', $page['pageType'], '', 'Page Type (alias): ', 'text');
                forms::select('pageTemplate', 'pageTemplate', $templates, '', '', 'Page Template: ', $page['pageTemplate']);
                forms::select('pageMenu', 'pagemenu', $menuOptions, '', '', 'Add to Menu: ');
                forms::input('pageHC', 'pageHC', $page['pageHC'], '', 'Page Hardcoded: ', 'checkbox');
                forms::textarea('pageContent', 'pageContent', $page['pageContent'], 'richEdit', 'Content: ', '1', '1');
                /*forms::input('tinyOff', 'tinyOff', '', '', 'Turn Off Tiny: ', 'checkbox');*/
                forms::input('pageComment', 'pageComment', $page['pageComment'], '', 'Page Comment: ', 'text');
                forms::input('savePage', 'savePage', 'Save', '', '&nbsp;', 'submit');
                forms::fieldsetClose();
                forms::closeForm();
			}
            admin::setupRichEdit();
		}
    }
	
	public static function updatePage($data) {

		if (is_array($data)) {
			$info = array(	'id' => $data['pageID'],
							'pageTitle' => $data['pageTitle'],
							'pageKey' => mysql_real_escape_string($data['pageKey']),
							'pageDesc' => $data['pageDesc']
						);
			$content = array(	'pageID' => $data['pageID'],
								'pageContent' => mysql_real_escape_string($data['pageContent']),
								'pageComment' => $data['pageComment']
							);
			DB::dbUpdate("pageinfo", $info, $data['pageID']);
			DB::dbUpdate("pagecontent", $content, $data['pageID']);
			actions::clearArray($data);
			echo "<p>The ".$data['pageComment']." page has been updated.</p>
                    <p><a href='?do=pages' title='Back to the page list'>Return</a></p>";
		} else {
			echo "Data HAS NOT passed as an array<br />";
		}
	}

    public static function savePage($data, $type, $id) {
        $templateName = explode(".",$data['pageURL']);
        $templateName = $templateName[0];
        if ($data['pageTemplate'] == "New") {    
            actions::createTemplate($templateName);
            $template = $templateName.".php";
        } else {
            $template = $data['pageTemplate'];
        }
        $pageName = $templateName;
        
        if (!actions::pageExists($pageName) && $type == "new") {
            echo "<p>You have attempted to add a page that already exists.</p>";
        } else {
            if (isset($data['pageHC'])) {
                $hc = "1";
            } else {
                $hc = "0";
            }
            if (is_array($data)) {
                $pageName = explode(".", $data['pageURL']);
                $pageName = $pageName[0];
                $url = self::checkURL($data['pageURL']);
                $pageInfo = array(  'pageName' => $pageName,
                                    'pageTitle' => $data['pageTitle'],
                                    'pageKey' => $data['pageKey'],
                                    'pageDesc' => $data['pageDesc'],
                                    'pageURL' => $url,
                                    'pageType' => $data['pageType'],
                                    'pageTemplate' => $template,
                                    'pageHC' => $hc
                                );
                switch($type) {
                    case "new":
                        DB::dbInsert('pageinfo', $pageInfo);
                        break;
                    case "update":
                        DB::dbUpdate('pageinfo', $pageInfo, "id='".$id."'");
                        break;
                    default:
                        DB::dbInsert('pageinfo', $pageInfo);
                        break;
                }
                if (isset($_REQUEST['pageID'])) {
                    $pageID = $_REQUEST['pageID'];
                } else {
                    $pageID = DB::dbQuery("SELECT id FROM pageinfo ORDER BY id DESC;", "1");
                }
                if ($data['mainImg'] == "0") {
                    $background = "";
                } else {
                    $background = $data['mainImg'];
                }
                $pageContent = array(   'pageID' => $pageID,
                                        'pageContent' => mysql_real_escape_string($data['pageContent']),
                                        'pageVersion' => '1',
                                        'pageComment' => $data['pageComment'],
                                        'mainImg' => $background,
                                        'pageHeader' => ''
                                );
                switch($type) {
                    case "new":
                        DB::dbInsert('pagecontent', $pageContent);
                        echo "<p>The ".$data['pageComment']." page has been added.</p>";
                        break;
                    case "update":
                        DB::dbUpdate('pagecontent', $pageContent, "pageID='".$pageID."'");
                        echo "<p>The ".$data['pageComment']." page has been updated.</p>";
                        break;
                    default:
                        DB::dbInsert('pagecontent', $pageContent);
                        echo "<p>The ".$data['pageComment']." page has been added.</p>";
                        break;
                }
                
                if ($data['pageMenu'] != "None") {
                    self::addToMenu($data);
                }
                actions::clearArray($data);
            } else {
                echo "Data HAS NOT passed as an array<br />";
            }
        }
        echo "<p><a href='?do=pages' title='Back to the page list'>Return</a></p>";
    }

    private static function addToMenu($data) {
        switch ($data['pageMenu']) {
            case "1":
                $menuName = "Main Menu";
                $next = DB::dbQuery("SELECT sitemenuOrder FROM sitemenu ORDER BY sitemenuOrder DESC;", '1');
                $order = $next+1;
                $url = self::checkURL($data['pageURL']);
                $menu = array(  'sitemenuOrder' => $order,
                                'sitemenuName' => $data['pageComment'],
                                'sitemenuLink' => $url,
                                'siteMenuTitle' => $data['pageTitle'],
                                'siteLinkPop' => '0',
                                'sitemenuImage' => '',
                                'sitemenuAlt' => $data['pageTitle'],
                                'sitemenuLoc' => '0'
                            );
                DB::dbInsert('sitemenu', $menu);
                break;
            case "2":
                $menuName = "Footer";
                $next = DB::dbQuery("SELECT menuOrder FROM footermenu ORDER BY menuOrder DESC;", '1');
                $order = $next+1;
                $page = explode(" ", $data['pageType']);
                $page = $page[0];
                $footer = array(    'menuOrder' => $order,
                                    'menuName' => $page,
                                    'menuLink' => $data['pageURL'],
                                    'menuTitle' => $page,
                                    'menuImage' => '',
                                    'linkPop' => '0',
                                    'menuAlt' => $data['pageType']
                                );
                 DB::dbInsert('footermenu', $footer);
                break;
            default:
                $table = "sitemenu";
                break;
        }
        echo "Add to ".$menuName." menu";
    }

    private static function checkURL($url) {
        if (strstr($url,".htm")) {
            return $url;
        } else {
            return $url = $url.".htm";
        }
    }

}

?>