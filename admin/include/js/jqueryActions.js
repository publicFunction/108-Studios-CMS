
$(document).ready(function() {
    //var draggables = $('#houseCount').text();

    $("#test-list").sortable({
        handle : '.dragDrop',
        update : function () {
            var order = $('#test-list').sortable('serialize');
            //console.log(order);
            $("#mainPropertyHolder").load("include/ajax/handleOrder.php?"+order, function (done) {
                if (done == "1") {
                    location.reload();
                } else {
                    window.href('login.php');
                }
            });
      }
    });

    $('#selectedImage').live('change', function(){
        var image = $(this).val();
        var $preview = $('#preview');
        var type = $(this).attr('name');
        $.post('include/ajax/handlePreview.php',{'type': type, 'image': image},function(data){
            $preview.html('');
            $preview.html(data);
        });
    });

    $('#pageHC').live('click', function(){
        var $content = $(this).closest('form').find('.mceEditor');
        if($(this).is(':checked')){
            $(this).attr('checked', true);
            $content.slideUp('500');
        } else {
            $(this).attr('checked', false);
            $content.slideDown('500');
        }
    });

    /*$('#tinyOff').live('click', function(){
        var $content = $(this).closest('form').find('.mceEditor');
        var $textarea = $(this).closest('form').find('#pageContent');
        var tinyID = $textarea.attr('id')+'_parent';
        if($(this).is(':checked')){
           var tinyMode = false;
           disableTiny(tinyID, tinyMode);
        } else {
           tinyMode = true;
           disableTiny(tinyID, tinyMode);
        }
    });*/

});

/*  Errors on these functions need to develop further   */
function disableTiny($el, mode) {
    try {
        if (mode) {
            tinyMCE.removeMCEControl(tinyMCE.getEditorId($el));
        } else {
            tinyMCE.addMCEControl(document.getElementById('pageContent'), $el);
        }
    } catch(error) {
        console.log(error.toString());
    }
}

function makePrimary(id) {
    $.post("include/ajax/handleBanner.php?id="+id, function (success) {
        if (success == "1") {
            location.reload();
        } else {
            alert('Banner '+id+' has failed to be made the primary...');
        }

    })
    
}

function saveComment(id) {

    var data = tinymce.EditorManager.get('comment_'+id).getContent();
    $.post("include/ajax/handleComments.php?id="+id+"&data="+data, function (success) {
        if (success == "1") {
            location.reload();
        } else {
            alert('Banner '+id+' has failed to be made the primary...');
        }

    })

}