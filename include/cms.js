$(document).ready(function(){

    $('#header-logo').live('click', function(){
        location.href = "./";
    });

    $('.content-text').live('click', function(){
        var page = $(this).attr('id');
        alert('GOTO THE PAGE: '+page+".htm");
    });

    if ($('.scrollable').length) {
        $('.scrollable').scrollable({'vertical': true});
    }

    /*
     *  Strip the additional ../ that the ajax loader has placed on the image urls to make the
     *  viewable on site as well as the in the editor
     */
     var $siteImgs = $('#site-content').find('img[src^=../]');
     var $imgs = $('#site-content').find('img');
     $.each($siteImgs, function(){
         $(this).attr('src', $(this).attr('src').replace(/..\//, ""));
     });

     /*
      * Replaces the site Image in the case study with the clicked thumbnail
      */
     $('.casestudy-thumb').live('click',function(){
         var $parent = $(this).closest('#list-data-info').find('#casestudy-snapshot img');
         var image = $(this).find('img').attr('src');
         $parent.attr('src',image);
     });
});

function getPage(loc) {
    loc = loc.split("/");
    var num = loc.length-1;
    loc = loc[num];
    loc = loc.split(".");
    loc = loc[0];
    return loc;
}