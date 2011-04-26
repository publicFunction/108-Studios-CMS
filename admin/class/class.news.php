<?php

class news {

    public static function listNews(){
        echo "  <p>
                    <a href='login.php?do=news&amp;action=add' title='Add new News Item'>Add News Item</a>
                </p>";
        $feeds = self::getNews('id','ASC');
        while($news = DB::dbFetch($feeds, 'assoc')) {
            echo "  <div class='holder'>
                        <div class='newsIcon'>
                            <a href='?do=news&amp;action=edit&amp;item=".$news['id']."' title='Edit news item'>
                                <img src='icons/news.png' alt='News icon' />
                            </a>
                        </div>
                        <div class='newsTitle'>".actions::shortenText($news['title'], 0, 10, true)."</div>
                    </div>";
        }
    }

    public static function addNews() {
        if (isset($_REQUEST['saveNews'])) {
            if ($_REQUEST['image'] == "0") {
                $image = "";
            } else {
                $image = $_REQUEST['image'];
            }
            $data = array(  'title' => mysql_real_escape_string($_REQUEST['title']),
                            'image' => $image,
                            'text' => mysql_real_escape_string($_REQUEST['text']),
                            'date' => actions::dbSafeDate($_REQUEST['date'])
                        );
            DB::dbInsert('news_items', $data);
            echo "  <p>New News Item Saved...</p>
                    <p><a href='login.php?do=news&amp;action=add' title='Add Another'>Add Another</a></p>";
        } else {
            $images = actions::getImages("../".UPLOAD_DIR.IMAGES_DIR);
            forms::openForm('addNews', 'addNews', 'login.php?do=news&amp;action=add', 'POST');
            forms::fieldsetOpen("Add a New Article");
            forms::input('title', 'title', '', '', 'Title: ', 'text');
            forms::select('image', 'selectedImage', $images, 'none', '0', 'Image: ');
            forms::textarea('text', 'text', '', '', 'Text: ', '1', '1');
            forms::input('date', 'date', '', 'datePicker', 'Date (dd-mm-yyyy): ', 'text');
            forms::input('saveNews', 'saveNews', 'Save', '', '&nbsp;', 'submit');
            echo "<div id='preview'></div>";
            forms::fieldsetClose();
            forms::closeForm();
        }
    }

    public static function editNews($id) {
        $article = self::getNewsItem($id);
        if (isset($_REQUEST['saveNews'])) {
            if ($_REQUEST['image'] == "0") {
                $image = "";
            } else {
                $image = $_REQUEST['image'];
            }
            $data = array(  'title' => mysql_real_escape_string($_REQUEST['title']),
                            'image' => $image,
                            'text' => mysql_real_escape_string($_REQUEST['text']),
                            'date' => actions::dbSafeDate($_REQUEST['date'])
                        );
            DB::dbUpdate('news_items', $data, $id);
            echo "<p>News Item Saved...</p>";
        } else {
            $images = actions::getImages("../".UPLOAD_DIR.IMAGES_DIR);
            while($item = DB::dbFetch($article, 'assoc')) {
                forms::openForm('editNews', 'editNews', 'login.php?do=news&amp;action=edit&amp;item='.$id.'', 'POST');
                forms::fieldsetOpen("Editing the ".$item['title']." article");
                forms::input('title', 'title', $item['title'], '', 'Title: ', 'text');
                forms::select('image', 'selectedImage', $images, 'none', '0', 'Image: ', $item['image']);
                forms::textarea('text', 'text', $item['text'], '', 'Text: ', '1', '1');
                forms::input('date', 'date', actions::reverseDate($item['date']), 'datePicker', 'Date (dd-mm-yyyy): ', 'text');
                forms::input('saveNews', 'saveNews', 'Save', '', '&nbsp;', 'submit');
                echo "<div id='preview'></div>";
                forms::fieldsetClose();
                forms::closeForm();
            }
        }
    }

    private static function getNews($order, $method) {
        $newsfeed = DB::dbQuery("SELECT * FROM news_items ORDER BY ".$order." ".$method.";", "0");
        return $newsfeed;
    }

    private static function getNewsItem($id) {
        $newsitem = DB::dbQuery("SELECT * FROM news_items WHERE id='".$id."';", "0");
        return $newsitem;
    }

    public static function displayNews() {
        $feed = self::getNews('date','DESC');
        if (DB::dbCount($feed) < "1") {
            return "<p>No news is good news</p>";
        } else {
            //$newsfeed = DB::dbFetch($feed, 'assoc');
            $item = "   <div class='items'>";
            while($news = DB::dbFetch($feed, 'assoc')) {
                if ($news['image'] == "" || $news['image'] == null) {
                    $image = SITE_LOGO;
                } else {
                    $image = $news['image'];
                }
                $item .= "      <div class='item'>
                                    <div class='newsArticle'>
                                        <div class='articleImg'>
                                            <img src='".UPLOAD_DIR.IMAGES_DIR.$image."' alt='".$news['title']."' />
                                        </div>
                                         <div class='articleText'>
                                            <p>".$news['text']."</p>
                                         </div>
                                        <div class='articleTitle'>".$news['title']."</div>
                                        <div class='articleDate'>".actions::prettyDate(actions::reverseDate($news['date']))."</div>
                                        <!--<div class='articleSpacer'></div>-->
                                    </div>
                                </div>";
            }
            $item .= "  </div>";
            return $item;
        }
    }

}
?>
