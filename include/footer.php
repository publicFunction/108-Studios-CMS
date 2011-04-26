    <div id="footer-container">
        <div id="transparent-background"></div>
        <div id="footer">
            <div id="footer-top">
                <div id="social-media">
                    <div id="like-box">
                        <?php
                            echo socialmedia::facebookLikeButton(SITE_URL, 'standard', false, '200', 'like','verdana','dark');
                        ?>
                    </div>
                    <div id="social-media-links">
                    <?php
                        menus::menuLinks('socialmedia');
                    ?>
                    </div>
                </div>
                <div id="footer-menu">
                    <?php
                        menus::menuLinks("footer");
                    ?>
                </div>
            </div>
            <div id="footer-bottom">
                <div id="footer-info">
                    <div id='footerPhone'>
                        <span class="highlight">Phone:</span> 0845 474 2569
                    </div>
                    <div id='footerEmail'>
                        <span class="highlight">Email:</span> info@technologyconsult.co.uk
                    </div>
                    <div id='footerAddress'>
                        <span class="highlight">Address:</span> 60a George Street, Edinburgh, EH2 2LR
                    </div>
                </div>
            </div>
        </div>
    </div>
