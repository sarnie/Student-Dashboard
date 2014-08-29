$(function() {

    studentListIDs = new Array();

    $(window).resize(function() {


        $.getJSON("data.php", function(data) {
            nv.addGraph(function() {
                var chart = nv.models.discreteBarChart()
                        .x(function(d) {
                            return d.label
                        })
                        .y(function(d) {
                            return d.value
                        })
                        .staggerLabels(true)
                        .tooltips(false)
                        .showValues(true)

                d3.select('#chart svg')
                        .datum(data)
                        .transition().duration(0)
                        .call(chart);
                nv.utils.windowResize(chart.update);
                return chart;
            });

        });

    }).resize();

    $('body').on('click', '.reset-filter', function() {
        filterTutor('all');
        $('#tutor-filter').val('none');
        $('#day-filter').val('none');
        $('#message-filter').val('none');
        return false;
    });

//Days Interaction
    $('body').on('change', '#day-filter', function() {
        if ($(this).val() != 'none') {
            filterDays($(this).val());
        }
    });




//Tutor Filter
    $('body').on('change', '#tutor-filter', function() {
        if ($(this).val() != 'none') {
            filterTutor($(this).val());

        }
    });

//Message Filter
    $('body').on('change', '#message-fliter', function() {
        if ($(this).val() != 'none') {
            msgLastSevenDays();
        }
    });


// Select all the check box
    $('body').on('click', '#select-all', function() {
        if ($(this).is(':checked')) {
            $('td input').prop('checked', true);

            //Loop through each checked and get the values
            $('td input').each(function() {
                studentListIDs.push($(this).val());
            });

        } else {
            $('td input').prop('checked', false);
        }
    });

// Single checkbox
    $('body').on('click', '.addStudent', function() {

        if ($(this).is(':checked')) {
            studentListIDs.push($(this).val());
            $('.alert').removeClass('show alert-danger');
        } else {
            if ($.inArray($(this).val(), studentListIDs) !== -1) {
                studentListIDs.splice($.inArray($(this).val(), studentListIDs), 1);
            }
        }
        ;

    });


    $('body').on('click', '.addIdList', function(e) {


        if ($('td input').is(':checked')) {
            $('#tutor-form #studIds').val(studentListIDs.join(","));
            $(window).scrollTop(0);
            $(".modal-holder").fadeIn(300);
            $(".modal-holder .modal-container").animate({top: 0}, 300);
        } else {
            $('.alert').addClass('show alert-danger').html('<strong>Select at least one student!</strong>  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>');

        }
        return false;
    });




    $('body').on('submit', '#tutor-form', function() {
        var tutorOptionID = $(this).find('.tutorOptionID').val();
        var theStudentID = $(this).find('#studIds').val();

        allocateTutors(tutorOptionID, theStudentID);

        return false;
    });



});// --------------------- end main

// Filter Tutor
function filterTutor(fValue) {
    $.ajax({
        type: "GET",
        url: "inc/view.php",
        data: 'tutorFilter=' + fValue,
        success: function(response) {
            $("#tutorStudentList").empty();
            $("#tutorStudentList").hide().html(response).fadeIn("slow");
            $('#day-filter').val('none');
            $('#message-fliter').val('none');
        }
    });
}

function filterDays(fValue) {
    $.ajax({
        type: "GET",
        url: "inc/view.php",
        data: 'theDays=' + fValue,
        success: function(response) {
            $("#tutorStudentList").empty();
            $("#tutorStudentList").hide().html(response).fadeIn("slow");
            $('#tutor-filter').val('none');
            $('#message-filter').val('none');
        }
    });
}

function allocateTutors(sValue, sIDs) {
    $.ajax({
        type: "GET",
        url: "inc/view.php",
        data: 'staffID=' + sValue + '&studIds=' + sIDs,
        success: function(response) {

            filterTutor('all');
            $('#tutor-form #studIds').val('');
            formSent();
            studentListIDs = new Array();
        }
    });
}


function msgLastSevenDays() {
    $.ajax({
        type: "GET",
        url: "inc/view.php",
        data: 'msgSeven=1',
        success: function(response) {
            $("#tutorStudentList").empty();
            $("#tutorStudentList").hide().html(response).fadeIn("slow");
            $('#tutor-filter').val('none');
            $('#day-filter').val('none');
        }
    });
}

function formSent() {

    $('.cancel-modal').trigger('click');
    $('.alert').addClass('show').html('<strong>Successfully Allocated!</strong>  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>');

    setTimeout(function() {
        $('.alert').fadeOut(300, function() {
            $('.alert').removeClass('show')
        });
    }, 2000);



}



