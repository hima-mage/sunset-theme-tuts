jQuery(document).ready(function($) {
    var mediaUploader;

    $('#upload-button').on('click' , function(e) {
        e.preventDefault(); 
        if(mediaUploader){
            // here after i click on the button it will open the media related to wordpress
            mediaUploader.open();
            return;
        }
        //  here i access the different stages of the media 
        //  i access file_frame which manage our custom media uploader
        // the i customize theis media uploader
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Upload Profile Picture', 
            button: {
                text:"Choose Picture", 
            }, 
            multiple: false // this mean that user can't choose multiple pic
        });

        // select is bind action to media uploader
        mediaUploader.on('select', function() {
            attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#profile-picture').val(attachment.url);
            $('#profile-picture-preview').css('background-image', 'url(' + attachment.url +')');
        });

        //  this prevent the dbClick for opening the media
        mediaUploader.open();
    });


    // Remove Profile-Picture Button Trigger
    $('#remove-profile-picture').on('click', function(e){
        e.preventDefault();
        var confirmation = confirm("Are You Sure Removing Profile Picture");
        if(confirmation == true){
            $('#profile-picture').val('');
            $('.sunset-general-form').submit();
        }  
        return;
    });
});