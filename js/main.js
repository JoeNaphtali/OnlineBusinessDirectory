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

    $('.set-bg-dark').each(function () {
        var bg = $(this).data('setbgdark');
        $(this).css('background-image', 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + bg + ')');
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

$(function () {
 
    var $rateYo = $("#read-write-rating").rateYo();
   
    $("#submit-review").click(function () {
      /* get rating */
      var rating = $rateYo.rateYo("rating");
      document.getElementById("review-rating").value = rating;
      window.alert("Its " + rating + " Yo!");
    });
   
  });

$(function () {
 
    $(".read-only-rating").rateYo();
   
});

$(document).ready(function(){

    // if the user clicks the 'like' button
    $('.like-btn').on('click', function(){
      var idea_id = $(this).data('id');
      $clicked_btn = $(this);
      if ($clicked_btn.hasClass('material-icons-outlined')) {
        action = 'like';
      }
      else if ($clicked_btn.hasClass('material-icons')) {
        action = 'unlike';
      }
      $.ajax({
        type: 'post',
        data: {
          'action': action,
          'idea_id': idea_id
        },
        success: function(data){ 
          var res = JSON.parse(data);     
          if (action == "like") {
            $clicked_btn.removeClass('material-icons-outlined');
            $clicked_btn.addClass('material-icons');
          } else if(action == "unlike") {
            $clicked_btn.removeClass('material-icons');
            $clicked_btn.addClass('material-icons-outlined');
          }
          // Display number of likes and dislikes
          $clicked_btn.siblings('span.likes').text(res.likes);
          $clicked_btn.siblings('span.dislikes').text(res.dislikes);
  
          // Change button styling of the dislike button if user is reacting for the second time to an idea
          $clicked_btn.siblings('i.material-icons').removeClass('material-icons').addClass('material-icons-outlined');
        }
      })
  
    });
  
  });