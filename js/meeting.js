$(function() {

    $(window).load(function() {
        $.urlParam = function(name) {
            var results = new RegExp('[\\?&amp;]' + name + '=([^&amp;#]*)').exec(window.location.href);
            return results[1] || 0;
        }

        var rqFromHome = decodeURIComponent($.urlParam('rq'));

        if (rqFromHome == 1) {
            $('body a.request-meeting')[0].click();
        } else {
        }
    });

    $('body').on('click', '.editMeeting', function() {
        var meetId = $(this).find('span').text();
        $('#meeting-update #meetID').val(meetId);
        $(".modal-holder").fadeIn(300);
        $(".modal-holder .modal-container").animate({top: 0}, 300);
        return false;
    });

    /* ======================== MEETING SUBMIT ======================== */
    $('#meeting-form').submit(function() {

        type = $(this).find('.type').val();
        agenda = $(this).find('.agenda').val();
        datepicker = $(this).find('#datepicker').val();
        OutwardHour = $(this).find('#OutwardHour').val();
        OutwardMinute = $(this).find('#OutwardMinute').val();
        var fullTime = OutwardHour + ':' + OutwardMinute;
        var sendForm = true;

        $("#meeting-form .required").each(function() {
            if ($(this).val() == '' || $(this).val() == 'none') {
                $(this).addClass('error');
                sendForm = false;
            }
        });

        if (sendForm == true) {
            $.ajax({
                type: "POST",
                url: "inc/view.php",
                data: {type: type, agenda: agenda, meetingDate: datepicker, meetingTime: fullTime},
                success: function() {
                    showAllMeetings();
                    formSent();
                }
            });
        }
        return false;
    });


    /* ======================== MEETING UPDATE SUBMIT ======================== */
    $('#meeting-update').submit(function() {
        details = $(this).find('#mdetails').val();
        metID = $(this).find('#meetID').val();

        $.ajax({
            type: "POST",
            url: "inc/view.php",
            data: {staffDetails: details, meetingID: metID},
            success: function() {
                updateMeetings();
                editSent();
            }
        });
        return false;
    });

    /* ======================== MEETING ACCEPT SUBMIT ======================== */
    $('body').on('click', '.acc', function() {
        metID = $(this).find('.hide').text();

        $.ajax({
            type: "POST",
            url: "inc/view.php",
            data: {happened: 1, meetingID: metID},
            success: function() {
                pendingMeetings();
                updateMeetings();
                actionSent();
            }
        });
        return false;
    });

    /* ======================== MEETING DECLINE SUBMIT ======================== */
    $('body').on('click', '.dec', function() {
        metID = $(this).find('.hide').text();
        $.ajax({
            type: "POST",
            url: "inc/view.php",
            data: {happened: 2, meetingID: metID},
            success: function() {
                pendingMeetings();
                updateMeetings();
                actionSent();
            }
        });
        return false;
    });
});// main



/* ======================== EVENT AFTER FORM SUBMITTED ======================== */

function formSent() {
    $('.cancel-modal').trigger('click');
    $('.alert').addClass('show');

    setTimeout(function() {
        $('.alert').fadeOut(300, function() {
            $('.alert').removeClass('show')
        });
    }, 2000);

    $('#meeting-form').find('.type').val('none');
    $('#meeting-form').find('.agenda').val('');
    $('#meeting-form').find('#datepicker').val('');
    $('#meeting-form').find('#OutwardHour').val('09');
    $('#meeting-form').find('#OutwardMinute').val('00');


    setTimeout(function() {
        $('#addMeetings table tr').removeClass('success')
    }, 3000);

}

/* ======================== SHOW THE MEETINGS ======================== */

function showAllMeetings() {
    $.ajax({
        type: "POST",
        url: "inc/view.php",
        data: 'getMeetings=1',
        success: function(response) {
            $("#addMeetings").empty();
            $("#addMeetings").hide().html(response).fadeIn("slow");
        }
    });
}

/* ======================== SHOW THE MEETINGS ======================== */

function updateMeetings() {
    $.ajax({
        type: "POST",
        url: "inc/view.php",
        data: 'updateMeetings=1',
        success: function(response) {
            $("#updateMeetings").empty();
            $("#updateMeetings").hide().html(response).fadeIn("slow");
        }
    });
}

/* ======================== SHOW THE MEETINGS ======================== */

function pendingMeetings() {
    $.ajax({
        type: "POST",
        url: "inc/view.php",
        data: 'pendingMeetings=1',
        success: function(response) {
            $("#pendingMeetings").empty();
            $("#pendingMeetings").hide().html(response).fadeIn("slow");
        }
    });
}

/* ======================== EVENT AFTER EDIT FORM SUBMITTED ======================== */

function editSent() {
    $('.cancel-modal').trigger('click');
    $('.alert').addClass('show');
    setTimeout(function() {
        $('.alert').fadeOut(300, function() {
            $('.alert').removeClass('show')
        });
    }, 2000);
    $('#meeting-update').find('.details').val('');
}


/* ======================== EVENT AFTER MEETING ACCEPTED ======================== */

function actionSent() {
    $('.alert').addClass('show');
    setTimeout(function() {
        $('.alert').fadeOut(300, function() {
            $('.alert').removeClass('show')
        });
    }, 2000);
    $('#meeting-action').find('.acc').val('');
}