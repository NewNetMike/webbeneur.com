(function($, cwp){
    $(document).ready(function(e){
        $(".cwp-quick-edit").click(function(e1){
            e1.preventDefault();
            toggleEditing($(this).attr("data-post"), true);
        });

        $(".cwp-quick-delete").click(function(e1){
            e1.preventDefault();
            var dataPostID      = $(this).attr("data-post-id");
            var dataNetwork     = $(this).attr("data-network");
            var anchor          = $(this);
            if($("#rop-delete-type").val() == -1){
                $("#thickbox-" + $(this).attr("data-post")).trigger("click");
                $("input[name='delete']").click(function(e2){
                    $("#rop-delete-type").val($(this).val());
                    tb_remove();
                    deleteAction(anchor, dataPostID, dataNetwork, $("#rop-delete-type").val());
                });
            }else{
                deleteAction(anchor, dataPostID, dataNetwork, $("#rop-delete-type").val());
            }
        });

        $(".cwp_post_image").click(function(e1){
            e1.preventDefault();
            openGallery($(this), $(this).attr("data-post-id"), $(this).attr("data-network"));
        });
        
        sidebarFunctions();
    });

    function sidebarFunctions(){
        $("#rop_custom_messages").on("click",function(){
            var state = "";
            var th  = $(this);
            if(th.hasClass("on")){
                state = "off";
                th.addClass("off").removeClass("on");
            }else{
                state = "on";
                th.addClass("on").removeClass("off");
            }
            $.ajax({
                type: "POST",
                url: cwp_top_ajaxload.ajaxurl,
                data: {
                    action: 'custom_messages',
                    state:state,
                    security: cwp["ajaxnonce"]
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(response) {
                    console.log("Error: "+ response);
                }
            });
            return false;
        })
    }

    function deleteAction(anchor, postID, network, type){
        $("body").css("cursor", "progress");
        $.ajax({
            url: ajaxurl,
            method: "post",
            data: {
                "action"    : cwp["delete_action"],
                "id"        : postID,
                "type"      : type,
                "network"   : network,
                "security"  : cwp["ajaxnonce"]
            },
            success: function(data, textStatus, jqXHR){
                var target  = anchor.parent().parent().parent().parent().parent();
                var dateDiv = target.parent();
                var tabDiv  = dateDiv.parent();
                target.hide('medium', function(){
                    target.remove();
                    if($(dateDiv).find("fieldset").length == 0){
                        dateDiv.remove();
                    }
                    if($(tabDiv).find("div").length == 0){
                        $(tabDiv).html(cwp["noTweets"]);
                    }
                });
            },
            complete: function(){
                $("body").css("cursor", "default");
            }
        });
    }

    function openGallery(div, postID, network){
        var frame;

        if ( frame ) {
            frame.open();
            return;
        }
    
        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Media Of Your Chosen Persuasion',
            button: {
                text: 'Use this media'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected in the media frame...
        frame.on( 'select', function() {
          
            // Get media attachment details from the frame state
            var attachment  = frame.state().get('selection').first().toJSON();

            $("body").css("cursor", "progress");
            $.ajax({
                url: ajaxurl,
                method: "post",
                data: {
                    "action"    : cwp["save_image_action"],
                    "id"        : postID,
                    "image"     : attachment.id,
                    "network"   : network,
                    "security"  : cwp["ajaxnonce"]
                },
                success: function(data, textStatus, jqXHR){
                    // Send the attachment URL to our custom image input field.
                    div.find("img").remove();
                    div.append( '<img src="'+attachment.url+'" class="top_preview"/>' );
                },
                complete: function(){
                    $("body").css("cursor", "default");
                }
            });
        });

        frame.open();
    }

    function toggleEditing(postID, start){
        $(".cwp-quick-edit-span[data-post='" + postID + "']").toggle();
        $(".cwp_quick_edit_actions_before[data-post='" + postID + "']").toggle();
        $(".cwp-quick-edit-text[data-post='" + postID + "']").toggle();
        $(".cwp_quick_edit_actions_after[data-post='" + postID + "']").toggle();
        $("#cwp-quick-cancel-button-" + postID).click(function(e){
            e.preventDefault();
            toggleEditing(postID, false);
        });
        $("#cwp-quick-save-button-" + postID).click(function(e){
            e.preventDefault();
            var content     = $(".cwp-quick-edit-text[data-post='" + postID + "']").val();
            var network     = $(".cwp-quick-edit-text[data-post='" + postID + "']").attr("data-network");
            $("body").css("cursor", "progress");
            $.ajax({
                url: ajaxurl,
                method: "post",
                dataType: "json",
                data: {
                    "action"    : cwp["save_content_action"],
                    "id"        : $(this).attr("data-post-id"),
                    "content"   : content,
                    "network"   : network,
                    "security"  : cwp["ajaxnonce"]
                },
                success: function(data, textStatus, jqXHR){
                    content     = data.data.content;
                    $(".cwp-quick-edit-span[data-post='" + postID + "']").html(content);
                    toggleEditing(postID, false);
                },
                complete: function(){
                    $("body").css("cursor", "default");
                }
            });
        });
    }
})(jQuery, cwp);