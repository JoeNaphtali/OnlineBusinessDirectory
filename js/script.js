$(document).ready(function () {

    $(document).click(function (event) {
        var click = $(event.target);
        var _open = $(".navbar-collapse").hasClass("show");
        if (_open === true && !click.hasClass("hamburger-icon")) {
            $(".hamburger-icon").click();
        }
    });

    $(document).click(function (event) {
        var click = $(event.target);
        var _open = $(".search-collapse").hasClass("show");
        if (_open === true && !click.hasClass("search-icon")) {
            $(".search-icon").click();
        }
    });
    
});