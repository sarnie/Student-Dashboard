$(document).ready(function() {

    $('#loadChecker').width($(window).width() - 92);

    $(window).load(function() {
        $('#loadChecker').fadeOut(300);
    });
    
    
    $('body').on('keydown','.required',function() {
        if($(this).hasClass('error')){
            $(this).removeClass('error');
        }
    });
    
    $('body').on('focus','select.required',function() {
        if($(this).hasClass('error')){
            $(this).removeClass('error');
        }
    });
    
    
    $('body').on('blur','#datepicker',function() {
        if($(this).hasClass('error')){
            $(this).removeClass('error');
        }
    });
    
    
    
   
   

    theCenter('.count-box p', '.count-box p span', 2, 2);
    theCenter('#tutor-box p', '#tutor-box p img', 1, 0);

    $("#datepicker").datepicker({
        dateFormat: 'dd/mm/yy',
        beforeShowDay: $.datepicker.noWeekends
    });

    $('body').on("click", ".comments", function() {
        $(this).parent().parent().find('.media-container').toggleClass('hide');
        return false;
    });


    $('body').on("click", ".addComment-btn", function() {
        $(this).parent().parent().find('.addComment').toggleClass('hide');
        return false;
    });

    $("#side-nav-btn").click(function() {
        $(this).toggleClass('btn-active');
        $("#side-nav").fadeToggle(0);
    });

    $(".request-meeting").click(function() {
        $(window).scrollTop(0);
        $(".modal-holder").fadeIn(300);
        $(".modal-holder .modal-container").animate({top: 0}, 300);

        return false;
    });

    $(".cancel-modal").click(function(e) {
        if (e.target !== this)
            return;

        $(".modal-holder").find('.modal-container').animate({top: -700}, 300);
        $(".modal-holder").delay(300).fadeOut(300);
        return false;
    });

    $('body').on('click', '.m-viewWrite', function() {
        var checkCurrentxt = $(this).parent().find('.change-title').html();
        var currentTxt = $(this).parent().find('.change-title').attr('data-current-txt');
        var newTxt = $(this).parent().find('.change-title').attr('data-new-txt');

        var btnCurrentTxt = $(this).attr('data-current-txt');
        var btnNewTxt = $(this).attr('data-new-txt');

        if (currentTxt == checkCurrentxt) {
            $(this).parent().find('.change-title').html(newTxt);
            $(this).addClass('btn-danger').removeClass('btn-success').html(btnNewTxt);
            $('.post-write').removeClass('hidden-xs');
        } else {
            $(this).parent().find('.change-title').html(currentTxt);
            $(this).addClass('btn-success').removeClass('btn-danger').html(btnCurrentTxt);
            $('.post-write').addClass('hidden-xs');
        }
    });


    $('body').on('change', '#optionStudent', function() {
        window.location = $(this).val();
    });


    $(window).resize(function() {
        var windowWidth = $(window).width();
        var sideNavWidth = $('#side-nav').width();
        var tutorBoxWidth = $('#tutor-box').width();
        var mainContainerWidth = windowWidth - sideNavWidth - tutorBoxWidth;
        var topNavHeight = $("#top-bar").height();
        var mainContainerHeight = $(window).height() - topNavHeight;

        $('.count-box p.circle').width($('#circleTran').width()).height($('#circleTran').width());

        if (windowWidth > 767) {
            $('#main-container').width(mainContainerWidth).css({
                'min-height': mainContainerHeight,
                'margin-top': topNavHeight
            });
            $("#side-nav").css('top', topNavHeight);
            $("#tutor-box").css('top', topNavHeight);
            $('.s-height').css('min-height', mainContainerHeight);
            $('.half').width(mainContainerWidth / 2);
        } else {
            $('.half').css('width', 100 + '%');
            $('#main-container').css('width', 100 + '%');
        }
        $('.w-height').css('min-height', $(window).height());

    }).resize();

    /* ======================== ALIGNING FUNCTION ======================== */
    function theCenter(pELe, cEle, eleLeft, eleTop) {
        //this.css("position","fixed");
        //this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
        if (eleTop == 1) {
            $(cEle).css("top", Math.max(0, (($(pELe).height() - $(cEle).outerHeight()) / 2) + $(pELe).scrollTop()) + "px");
        } else if (eleLeft == 1) {
            $(cEle).css("left", Math.max(0, (($(pELe).width() - $(cEle).outerWidth()) / 2) + $(pELe).scrollLeft()) + "px");
        } else if (eleTop == 2 && eleLeft == 2) {
            $(cEle).css("top", Math.max(0, (($(pELe).height() - $(cEle).outerHeight()) / 2) + $(pELe).scrollTop()) + "px");
            $(cEle).css("left", Math.max(0, (($(pELe).width() - $(cEle).outerWidth()) / 2) + $(pELe).scrollLeft()) + "px");
        }
    }
});

