<?php

class CTA {

    public static function listCTA() {
        echo "  <p>
                    <a href='login.php?do=cta&amp;action=add' title='Add new Call To Action'>Add new Call To Action</a>
                </p>";
        $cta = self::getCTA();
        while($article = DB::dbFetch($cta, 'assoc')) {
            echo "  <div class='holder'>
                        <div class='articleIcon'>
                            <a href='?do=cta&amp;action=edit&amp;item=".$article['id']."' title='Edit Article'>
                                <img src='icons/attachment.png' alt='Article icon' />
                            </a>
                        </div>
                        <div class='articleTitle'>".actions::shortenText($article['text'], 0, 10, true)."</div>
                    </div>";
        }
        
    }

    public static function editCTA($id) {
        $article = self::getCTAArticle($id);
        if (isset($_REQUEST['saveArticle'])) {
            if ($_REQUEST['image'] == "0") {
                $image = "";
            } else {
                $image = $_REQUEST['image'];
            }
            if($_REQUEST['featured'] == "" || $_REQUEST['featured'] == null) {
                $featured = false;
            } else {
                $featured = true;
            }
            $data = array(  'image' => $image,
                            'text' => mysql_real_escape_string($_REQUEST['text']),
                            'link' => $_REQUEST['pages'],
                            'featured' => $featured
                        );
            DB::dbUpdate('calls_to_action', $data, $id);
            echo "<p>Call To Action Saved...</p>";
        } else {
            $images = actions::getImages("../".UPLOAD_DIR."polaroids/");
            $pages = actions::getPages();
            while($item = DB::dbFetch($article, 'assoc')) {
                forms::openForm('editArticle', 'editArticle', 'login.php?do=cta&amp;action=edit&amp;item='.$id.'', 'POST');
                forms::fieldsetOpen("Editing the ".$item['text']." article");
                forms::select('ctaImage', 'selectedImage', $images, 'none', '0', 'Image: ', $item['image']);
                forms::input('text', 'text', $item['text'], '', 'Text: ', 'text');
                forms::select('pages', 'selectedPage', $pages, 'none', '0', 'Link To: ', $item['link']);
                forms::input('featured', 'featured', $item['featured'], '', 'Featured: ', 'checkbox');
                forms::input('saveArticle', 'saveArticle', 'Save', '', '&nbsp;', 'submit');
                echo "<div id='preview'></div>";
                forms::fieldsetClose();
                forms::closeForm();
            }
        }
    }

    public static function addCTA() {
        if (isset($_REQUEST['saveArticle'])) {
            if ($_REQUEST['image'] == "0") {
                $image = "";
            } else {
                $image = $_REQUEST['image'];
            }
            if($_REQUEST['featured'] == "" || $_REQUEST['featured'] == null) {
                $featured = "0";
            } else {
                $featured = "1";
            }
            $data = array(  'page_id' => "1",
                            'image' => $image,
                            'text' => mysql_real_escape_string($_REQUEST['text']),
                            'link' => $_REQUEST['pages'],
                            'featured' => $featured
                        );
            DB::dbInsert('calls_to_action', $data);
            echo "  <p>Call To Action Saved...</p>
                    <p><a href='login.php?do=cta&amp;action=add' title='Add Another'>Add Another</a></p>";
        } else {
            $images = actions::getImages("../".UPLOAD_DIR.IMAGES_DIR);
            $pages = actions::getPages();
            forms::openForm('addArticle', 'addArticle', 'login.php?do=cta&amp;action=add', 'POST');
            forms::fieldsetOpen("Adding a New Call To Action");
            forms::select('image', 'selectedImage', $images, 'none', '0', 'Image: ');
            forms::input('text', 'text', '', '', 'Text: ', 'text');
            forms::select('pages', 'selectedPage', $pages, 'none', '0', 'Link To: ');
            forms::input('featured', 'featured', '', '', 'Featured: ', 'checkbox');
            forms::input('saveArticle', 'saveArticle', 'Save', '', '&nbsp;', 'submit');
            echo "<div id='preview'></div>";
            forms::fieldsetClose();
            forms::closeForm();
        }
    }

    private static function getCTA() {
        $list = DB::dbQuery("SELECT * FROM calls_to_action ORDER BY id ASC;", "0");
        return $list;
    }

    private static function getCTAArticle($id) {
        $article = DB::dbQuery("SELECT * FROM calls_to_action WHERE id='".$id."';", "0");
        return $article;
    }

}
?>
