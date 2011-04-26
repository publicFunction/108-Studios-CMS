<?php

class socialmedia {

    public function facebookLikeButton($site, $layout, $faces, $width, $verb, $font, $color) {
        $url = urlencode($site);
        $likeUrl = "<iframe src='http://www.facebook.com/plugins/like.php?";
        if ($site) {
            $likeUrl .= "href=".$url."&amp;";
            $likeUrl .= "layout=".$layout."&amp;";
            if($faces) {
                $likeUrl .= "show_faces=true&amp;";
            } else {
                $likeUrl .= "show_faces=false&amp;";
            }
            $likeUrl .= "width=".$width."&amp;";
            $likeUrl .= "action=".$verb."&amp;";
            $likeUrl .= "font=".$font."&amp;";
            $likeUrl .= "colorscheme=".$color."&amp;";
            $likeUrl .= "height=35' scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:".$width."; height:35px;' allowtransparency='true'></iframe>";
            return $likeUrl;
        } else {
            return "<p class='error'>The Like button must have a URL</p>";
        }
    }

    public static function facebookliveStream($site, $width, $color, $faces, $stream, $header, $height) {
        $url = urlencode($site);
        $liveStream = "<iframe src='http://www.facebook.com/plugins/likebox.php?";
        if ($site) {
            $liveStream .= "href=".$url."&amp;";
            $liveStream .= "width=".$width."&amp;";
            $liveStream .= "colorscheme=".$color."&amp;";
            if($faces) {
                $liveStream .= "show_faces=true&amp;";
            } else {
                $liveStream .= "show_faces=false&amp;";
            }
            if($stream) {
                $liveStream .= "stream=true&amp;";
            } else {
                $liveStream .= "stream=false&amp;";
            }
            if($header) {
                $liveStream .= "header=true&amp;";
            } else {
                $liveStream .= "header=false&amp;";
            }
            $liveStream .= "height=".$height."' ";
            $liveStream .= "scrolling='no' frameborder='0' style='border:none; overflow:hidden; width:".$width."px; height:".$height."px;' allowtransparency='true'></iframe>";
            return $liveStream;
        } else {
            return "<p class='error'>The Like button must have a URL</p>";
        }
        echo '';
    }

    public static function twitterStream($user, $width, $height){
        echo "  <script src='http://widgets.twimg.com/j/2/widget.js'></script>
                    <script>
                    new TWTR.Widget({
                      version: 2,
                      type: 'profile',
                      rpp: 4,
                      interval: 6000,
                      width: ".$width.",
                      height: ".$height.",
                      theme: {
                        shell: {
                          background: '#333333',
                          color: '#ffffff'
                        },
                        tweets: {
                          background: '#000000',
                          color: '#ffffff',
                          links: '#4aed05'
                        }
                      },
                      features: {
                        scrollbar: false,
                        loop: false,
                        live: false,
                        hashtags: true,
                        timestamp: true,
                        avatars: false,
                        behavior: 'all'
                      }
                    }).render().setUser('".$user."').start();
                    </script>";
    }


    public static function facebookLink($url) {
        return "<a id='facebook-link' href='".$url."' title='Facebook Page'>
                    <img src='imgs/social_media_facebook.png' alt='Facebook Page' />
                </a>";
    }

    public static function twitterLink($url) {
        return "<a id='twitter-link' href='".$url."' title='Twitter Page'>
                    <img src='imgs/social_media_twitter.png' alt='Twitter Page' />
                </a>";
    }

    public static function linkedinLink($url) {
        return "<a id='linkedin-link' href='".$url."' title='Linked In Profile Page'>
                    <img src='imgs/social_media_linkedin.png' alt='Linked In Profile Page' />
                </a>";
    }

}

?>
