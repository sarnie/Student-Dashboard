$(function() {

   
    

    $("body").on('click', '.addCommentBtn', function() {
        $(this).hide();
        $(this).parent().find('.addComment').removeClass('hide');
        return false;
    });

    $("body").on('click', '.upload-cw-btn', function() {

        var upTitle = $(this).parent().find('.uptitle').text();
        var upDate = $(this).parent().find('.update').text();

        $(".modal-holder").fadeIn(300);


        $('#cwForm').find('#UploadTitle').val(upTitle);
        $('#cwForm').find('#uploadDate').val(upDate);
        $(".modal-holder .modal-container").animate({top: 0}, 300);

        return false;
    });
    
    $("body").on('submit', '#add-upload-comment', function() {
       var upComment = $(this).find('textarea').val();
       var upID = $(this).parent().parent().attr('id');
      
       $.ajax({
            type: "GET",
            url: "inc/view.php",
            data: {uploadComment:upComment,uploadID:upID},
            success: function() {
              $('#'+upID+' p').removeClass('hide').html(upComment);
              $('#'+upID+' .addComment').addClass('hide');
            }
        });
        
        return false;
    });


    var progressbox = $('#progressbox');
    var progressbar = $('#progressbar');
    var statustxt = $('#statustxt');
    var completed = '0%';

    var options = {
        target: '#output p', // target element(s) to be updated with server response 
        beforeSubmit: beforeSubmit, // pre-submit callback 
        uploadProgress: OnProgress,
        success: afterSuccess, // post-submit callback 
        resetForm: true        // reset the form after successful submit 
    };

    $('body').on('submit', '#cwForm', function() {
        $(this).ajaxSubmit(options);
        // return false to prevent standard browser submit and page navigation 
        return false;
    });
    
    
     $('body').on('click','.cancel-upload',function(e) {
        if (e.target !== this)
            return;

        $(".modal-holder").find('.modal-container').animate({top: -700}, 300);
        $(".modal-holder").delay(300).fadeOut(300);
        
        $('#FileInput').val('');
            $('.btn-sect').show();
            progressbox.addClass('hide'); //show progressbar
            $("#output p").html("");
            progressbar.width(0); //initial value 0% of progressbar

        return false;
    });



//when upload progresses	
    function OnProgress(event, position, total, percentComplete)
    {
        //Progress bar
        progressbar.width(percentComplete + '%') //update progressbar percent complete
        statustxt.html(percentComplete + '%'); //update status text
    }

//after succesful upload
    function afterSuccess()
    {
        $('.btn-sect').hide(); //hide submit button
        refreshTheForm();
    }

//function to check file size before uploading.
    function beforeSubmit() {
        //check whether browser fully supports all File API
        if (window.File && window.FileReader && window.FileList && window.Blob)
        {

            if (!$('#FileInput').val()) //check empty input filed
            {
                $("#output p").html("No File Selected");
                return false
            }

            var fsize = $('#FileInput')[0].files[0].size; //get file size
            var ftype = $('#FileInput')[0].files[0].type; // get file type

            //allow only valid image file types 
            switch (ftype)
            {
                case 'application/x-zip-compressed':
                case 'application/pdf':
                case 'application/msword':
                case 'application/vnd.ms-excel':
                    break;
                default:
                    $("#output p").html("<b>" + ftype + "</b> Unsupported file type!");
                    return false
            }


            //Allowed file size is less than 1 MB (1048576) -- Currently set to 20MB
            if (fsize > 20971520)
            {
                $("#output").html("<b>" + bytesToSize(fsize) + "</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
                return false
            }

            //Progress bar
            progressbox.removeClass('hide'); //show progressbar
            progressbar.width(completed); //initial value 0% of progressbar
            statustxt.html(completed); //set status text
            //statustxt.css('color','#000'); //initial color of status text


            $('.btn-sect').hide(); //hide submit button
            //	$('#loading-img').show(); //hide submit button
            $("#output p").html("");
        }
        else
        {
            //Output error to older unsupported browsers that doesn't support HTML5 File API
            $("#output p").html("Please upgrade your browser, because your current browser lacks some new features we need!");
            return false;
        }
    }

//function to format bites bit.ly/19yoIPO
    function bytesToSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0)
            return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }

    function refreshTheForm() {
        setTimeout(function() {

            $('.cancel-upload').trigger('click');

            showAllMeetings();

            

        }, 1000);

    }


    function showAllMeetings() {
        $.ajax({
            type: "POST",
            url: "inc/view.php",
            data: 'getUploads=1',
            success: function(response) {
                $("#addUploads").empty();
                $("#addUploads").hide().html(response).fadeIn("slow");
            }
        });
    }

});


