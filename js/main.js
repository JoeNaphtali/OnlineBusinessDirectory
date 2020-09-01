$(document).ready(function () {
    
    /* Navigation */

    $(document).click(function (event) {
        if ($(event.target).parents(".navbar-collapse").length < 1) {
            var click = $(event.target);
            var _open = $(".navbar-collapse").hasClass("show");
            if (_open === true && !click.hasClass("hamburger-icon")) {      
                $(".hamburger-icon").click();
            }
        }
    });

    $(document).click(function (event) {
        if ($(event.target).parents(".search-collapse").length < 1) {
            var click = $(event.target);
            var _open = $(".search-collapse").hasClass("show");
            if (_open === true && !click.hasClass("search-icon")) {      
                $(".search-icon").click();
            }
        }
    });

    /* Background Set */

    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })

    $(window).scroll(function(){
        $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
    });

    /* Toggle distance radius control */

    $('#enableDistanceRadius').click(function(){
        // If the user checks the terms and conditions checkbox
        if($(this).is(':checked')){
            // Enable the 'Propose Idea' button.
            $('.distanceRangeInput').attr("disabled", false);
        } else{
            // If the user did not check the terms and conditions checkbox
            $('.distanceRangeInput').attr("disabled", true);
        }
    });

    /* Toggle search map on mobile view */

    $('.dropdown-panel-toggle').click(function(){
        $(".dropdown-panel-content").fadeToggle();
    });

    $('#show-map').click(function(){
        $('.map-container').removeClass('collapse-map');
        $('.map-container').addClass('display-map');
    });

    $('#hide-map').click(function(){
        $('.map-container').removeClass('display-map');
        $('.map-container').addClass('collapse-map');
    });

    $(window).resize(function() {
        if (window.matchMedia('(min-width: 767px)').matches) {
            $('.map-container').removeClass('hide');
            $('.map-container').removeClass('show');
        }
    });

});