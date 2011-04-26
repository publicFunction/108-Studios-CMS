<?php
require_once("include/header.php");
?>
        <div id="background">
            <img src="<?php echo pageSetup::loadPageBackground(); ?>" alt="site background" id="background-image" />
        </div>
        <div id="site">
            <div id="header">
                <div id="gradient"></div>
                <div id="header-content">
                    <div id="header-logo">
                        <?php
                            echo pageSetup::loadPageHeadImg(pageSetup::setPage());
                        ?>
                    </div>
                    <div id="header-menu">
                        <?php
                            menus::menuLinks('default');
                        ?>
                    </div>
                </div>
            </div>
            <div id="site-content">
                <?php
                    echo pageSetup::loadTemplate(TEMPLATE_DIR.pageSetup::getTemplate());
                ?>

            </div>
            <?php
                require_once("include/footer.php");
            ?>
        </div>
<?php
    
?>
    </body>
</html>