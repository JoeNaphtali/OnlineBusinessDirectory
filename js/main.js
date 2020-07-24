$(document).ready(function () {
    
    /*------------------
        Navigation
    --------------------*/

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

    /*------------------
        Background Set
    --------------------*/
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
    
});