$(function() {

    sEmailList = new Array();

    if ($('#emails').length > 0) {

        $.getJSON("studentemails.php", function(data) {
            $("#emailList").autocomplete({
                source: data
            });
        });

        $('body').on('focusout', '#emails input', function() {
            //  var txt = this.value.replace(/[^a-zA-Z0-9\+\-\.\#]/g, ''); // allowed characters
            var txt = this.value; // allowed characters

            if (txt) {
                $(this).before('<span class="tag">' + txt.toLowerCase() + '</span>');

                sEmailRaw = txt.toLowerCase();
                sEmailRaw = sEmailRaw.substr(sEmailRaw.lastIndexOf(">") + 2);
                sEmail = sEmailRaw.replace(/,\s*$/, '');
                sEmailList.push(sEmail);
            }
            this.value = "";
        }).on('keyup', '#emails input', function(e) {
            // if: comma,enter (delimit more keyCodes with | pipe)
            if (/(188|13)/.test(e.which))
                $(this).focusout();
        });


        $('#emails').on('click', '.tag', function() {
            $(this).remove();
        });


        $('body').on('focus','#msgForm textarea',function() {
            $('#msgForm #eSlist').val(sEmailList.join(","));
        });
    }
    
    

    $('body').on('submit','#msgForm',function() {

        var theText = $('#messageText').val();
        var eSlist = $('#eSlist').val();
        
        
        
        if (theText === '' || eSlist === '') {
            $('#emails').addClass('error');
            $('#messageText').parent().addClass('has-error');
            $('#messageText').parent().find('.control-label').text('No Content!').removeClass('hide');

            $('#messageText').on("keydown", function() {
                $(this).parent().removeClass('has-error');
                $(this).parent().find('.control-label').addClass('hide');
            });

        } else {
         
            $.ajax({
                type: "POST",
                url: "inc/view.php",
                data: 'messageText='+theText+'&toEmail='+eSlist,
                success: function() {
                    showAllSent();
                    formSent();
                    $('#messageText').val('');
                    $('#emails span.tag').remove();
                }
            });
            
        }

        return false;
    });


});


function showAllSent() {
    $.ajax({
        type: "GET",
        url: "inc/view.php",
        data: 'getSentMsg=1',
        success: function(response) {
            $("#outbox").empty();
            $("#outbox").html(response);
        }
    });
}

function formSent() {


    $('.alert').addClass('show');

    setTimeout(function() {
        $('.alert').fadeOut(300, function() {
            $('.alert').removeClass('show')
        });
    }, 2000);
}
