<?php

class admin {

    public static function setupTiny() {
        echo "  <script type='text/javascript'>
                        tinyMCE.init({
                            mode : 'textareas',
                            theme : 'advanced',
                            /*editor_selector : 'tinyEdit',*/
                            skins: 'o2k7',
                            document_base_url: '".SITE_URL."',
                            content_css : '../css/cms.css',
                            plugins : 'safari,style,layer,table,save,advhr,advimage,advlink,inlinepopups,media,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,template,imagemanager,code',

                            theme_advanced_buttons1 : 'bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,cut,copy,paste,pasteword,|,formatselect,fontselect,fontsizeselect,|,code',
                            theme_advanced_buttons2 : 'bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,tablecontrols,removeformat,|,fullscreen',

                            theme_advanced_toolbar_location : 'top',
                            theme_advanced_toolbar_align : 'left',
                            theme_advanced_statusbar_location : 'bottom',
                            theme_advanced_resizing : false,

                            file_browser_callback : 'ajaxfilemanager',
                            theme_advanced_resizing : true,
                            theme_advanced_resize_horizontal : true,
                            apply_source_formatting : true,
                            force_br_newlines : true,
                            force_p_newlines : false,
                            relative_urls : true

                        });
                        
                    </script>";
    }

    public static function setupTinyMini() {
        echo "  <script type='text/javascript'>
                        tinyMCE.init({
                            mode : 'textareas',
                            skins: 'o2k7',
                            theme_advanced_toolbar_location : 'top',
                            theme_advanced_toolbar_align : 'left',
                        });
                    </script>";
    }

    public static function setDo($set, $task) {
        echo "<div class='content1'>";
        switch($set) {
            case "manageAcc":
                switch($task) {
                    case "edit":
                        account::editAccount();
                        break;
                    case "update":
                        account::updateAccount();
                        break;
                    case "add":
                        account::addAccount();
                        break;
                    default:
                        account::listAccounts('admin');
                        break;
                }
                break;
            case "myAccount":
                account::myAccount();
                break;

            case "contact":
                if (isset($_REQUEST['id'])) {
                    $contact = $_REQUEST['id'];
                }
                switch ($task) {
                    case "edit":
                        contacts::viewContact($contact);
                        break;
                    case "remove":
                        contacts::deleteContact($contact);
                        break;
                    case "save":
                        contacts::completeContact($contact);
                        break;
                    default:
                        contacts::listContacts();
                        break;
                }
                break;
            case "group":
                if (isset($_REQUEST['item'])) {
                    $type = $_REQUEST['item'];
                }
                switch($task) {
                    case "add":
                        CaseStudy::addGroup($type);
                        break;
                    case "edit":

                        break;
                    case "delete":

                        break;
                    default:
                        
                        break;
                }
                break;
            case "web":
                if (isset($_REQUEST['item'])) {
                    $id = $_REQUEST['item'];
                }
                switch($task) {
                    case "add":
                        CaseStudy::addCaseStudy('web');
                        break;
                    case "edit":
                        CaseStudy::editCaseStudy($id,'web');
                        break;
                    case "delete":
                        //news::deleteNews($id);
                        break;
                    default:
                        CaseStudy::listCaseStudies('web');
                        break;
                }
                break;

            case "app":
                if (isset($_REQUEST['item'])) {
                    $id = $_REQUEST['item'];
                }
                switch($task) {
                    case "add":
                        CaseStudy::addCaseStudy('app');
                        break;
                    case "edit":
                        CaseStudy::editCaseStudy($id,'app');
                        break;
                    case "delete":
                        //news::deleteNews($id);
                        break;
                    default:
                        CaseStudy::listCaseStudies('app');
                        break;
                }
                break;

            case "news":
                if (isset($_REQUEST['item'])) {
                    $id = $_REQUEST['item'];
                }
                switch($task) {
                    case "add":
                        news::addNews();
                        break;
                    case "edit":
                        news::editNews($id);
                        break;
                    case "delete":
                        news::deleteNews($id);
                        break;
                    default:
                        news::listNews();
                        break;
                }
                break;

            case "vacancy":
                if (isset($_REQUEST['id'])) {
                    $job = $_REQUEST['id'];
                }
                switch ($task) {
                    case "edit":
                        vacancy::editJob($job);
                        break;
                    case "view":
                        cv::viewCV($job);
                        break;
                    case "remove":
                        vacancy::deleteJob($job);
                        break;
                    case "add":
                        vacancy::addJob();
                        break;
                    case "applicant":
                        vacancy::viewApplications($job);
                        break;
                    case "applications":
                        vacancy::viewApplicant($job);
                        break;
                    default:
                        vacancy::listJobs('admin');
                        break;
                }
                break;

            case "cvs":
                if (isset($_REQUEST['id'])) {
                    $client = $_REQUEST['id'];
                }
                switch ($task) {
                    case "view":
                        cv::viewCV($client);
                        break;
                    case "search":
                        cv::searchCVs();
                        break;
                    default:
                        cv::viewAll();
                        break;
                }
                break;

            case "banner":
                if (isset($_REQUEST['id'])) {
                    $banner = $_REQUEST['id'];
                }
                switch($task) {
                    case "edit":
                        banner::editComments();
                        break;
                    case "upload":
                        banner::addNewBanner();
                        break;
                    case "removeBanner":
                        banner::removeBanner($banner);
                        break;
                    case "add":
                        banner::addNewBanner();
                        break;
                    default:
                        banner::listBanners();
                        break;
                }
                break;

            case "pages":
                switch($task) {
                    case "add":
                        pages::addPage();
                        break;
                    case "edit":
                        if (isset($_REQUEST['page'])) {
                            $page = $_REQUEST['page'];
                        } else {
                            $page = "";
                        }
                        pages::editPage($page);
                        break;
                    default:
                        pages::listPages();
                        break;
                }
                break;

            case "cta":
                if (isset($_REQUEST['item'])) {
                    $id = $_REQUEST['item'];
                }
                switch($task) {
                    case "add":
                        CTA::addCTA();
                        break;
                    case "edit":
                        CTA::editCTA($id);
                        break;
                    default:
                        CTA::listCTA();
                        break;
                }
                break;

            case "registry":
                settings::showReg();
                break;
            case "main":
                admin::getHomePageContent();
                break;
				
            default:
                admin::getHomePageContent();
                break;
        }
        echo "</div>";
    }

    public static function getHomePageContent() {
        $getContent = DB::dbQuery("SELECT reg_value FROM register WHERE reg_param='ADMIN_HOMEPAGE_CONTENT';", "0", "");
        $showContent = mysql_fetch_array($getContent);
        echo $showContent[0];
    }

    public static function getAdminStatus() {
        $getAdminStatus = DB::dbQuery("SELECT activationStatus FROM adminactivation WHERE admin_ID = '".$_SESSION['userID']."';", "0");
        $status = mysql_fetch_assoc($getAdminStatus);
        if ($status['activationStatus'] != 1) {
                return false;
        } else {
                return true;
        }
    }

    public static function showActivationMsg() {
        if (isset($_REQUEST['do']) && $_REQUEST['do'] == "myAccount") {
            echo "<div class='content1_admin'>";
            account::editAccount();
            echo "</div>";
        } else {
            echo "<p>Your Admin Account has not been activated, please go to <a href='login.php?do=myAccount' title='activate your account'>your account</a> and enter the activation code you were sent or get the Super Admin to activate your account.</p>";
        }
    }

    public static function chkExtendedRights() {
        $getAdminRights = DB::dbQuery("SELECT adminlogin.adminRight, adminrights.rightsValue, adminrights.rightsName FROM adminlogin INNER JOIN adminrights WHERE adminrights.rightsValue = adminlogin.adminRight AND adminlogin.adminID = '".$_SESSION['userID']."';", "0");
        $adminRights = mysql_fetch_assoc($getAdminRights);
        if ($adminRights['adminRight'] == "1") {
                return true;
        } else {
                return false;
        }
    }

    public static function showExtendedRights() {
        echo "	<div class='allAccount'>
                    <a href='login.php?do=allAccounts' title='Edit all Account'><img src='icons/user.png' alt='My Account' /></a>
                </div>";
    }
	
    public static function setupRichEdit() {
        echo "<script type='text/javascript'>
                        tinyMCE.init({
                                mode : 'textareas',
                                theme : 'advanced',
                                width: '710',
                                height: '600',
                                editor_selector : 'richEdit',
                                skins: 'o2k7',
                                plugins : 'style,layer,table,save,advhr,advimage,advlink,inlinepopups,media,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager',
                                content_css : '../css/cms.css',
                                theme_advanced_buttons1 : 'bold,italic,underline,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,justifyfull,|,cut,copy,paste,pasteword,|,undo,redo,|,code,|,help',
                                theme_advanced_buttons2 : 'formatselect,fontselect,fontsizeselect,|,bullist,numlist,|,outdent,indent,|,link,unlink,anchor,image,cleanup',
                                theme_advanced_buttons3 : 'tablecontrols,hr,removeformat,|,fullscreen',

                                theme_advanced_toolbar_location : 'top',
                                theme_advanced_toolbar_align : 'left',
                                theme_advanced_statusbar_location : 'bottom',
                                theme_advanced_resizing : false,
                                
                                file_browser_callback : 'ajaxfilemanager',
                                theme_advanced_resizing : true,
                                theme_advanced_resize_horizontal : true,
                                apply_source_formatting : true,
                                force_br_newlines : true,
                                force_p_newlines : false,
                                relative_urls : true

                        });
                        
                        function ajaxfilemanager(field_name, url, type, win) {
                            var ajaxfilemanagerurl = 'include/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php';
                            switch (type) {
                                case 'image':
                                    break;
                                case 'media':
                                    break;
                                case 'flash':
                                    break;
                                case 'file':
                                    break;
                                default:
                                    return false;
                            }
                            tinyMCE.activeEditor.windowManager.open({
                                url: 'include/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php',
                                width: 782,
                                height: 440,
                                inline : 'yes',
                                close_previous : 'no'
                            },
                            {
                                window : win,
                                input : field_name
                            });
                        }
                </script>";
    }
	
}

?>