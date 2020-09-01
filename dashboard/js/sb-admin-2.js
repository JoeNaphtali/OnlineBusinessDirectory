(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  $(document).ready(function() {
    $('#summernote').summernote({
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'italic', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link','hr']],
        ['view', ['fullscreen', 'help']]
      ]
    });
  });

  $(document).ready(function(){
    $('#opening-hours-switch').click(function(){
        // If the user turns on the 'opening hours' switch
        if($(this).is(':checked')){
            // Enable the time inputs
            $('.datetimepicker-input').attr("disabled", false);
        } else{
            // If the user turns off the 'opening hours' switch, disable the time inputs
            $('.datetimepicker-input').attr("disabled", true);
        }
    });
  });

  $(document).ready(function(){
    $('#pricing-switch').click(function(){
        // If the user turns on the 'pricing' switch
        if($(this).is(':checked')){
            // Enable the input fields
            $('.pricing-input').attr("disabled", false);
        } else{
            // If the user turns off the 'pricing' switch, disable the input fields
            $('.pricing-input').attr("disabled", true);
        }
    });
  });

  $(document).ready(function(){
    $('#amenities-switch').click(function(){
        // If the user turns on the 'pricing' switch
        if($(this).is(':checked')){
            // Enable the input fields
            $('.amenity').attr("disabled", false);
        } else{
            // If the user turns off the 'pricing' switch, disable the input fields
            $('.amenity').attr("disabled", true);
        }
    });
  });

  $(document).ready(function(){

    var item_row = '<div class="form-row item"><div class="form-group col-md-3"><input class="form-control pricing-input" type="text" name="item-name" placeholder="Name"></div><div class="form-group col-md-2"><input class="form-control pricing-input" type="text" name="price" placeholder="Price"></div><div class="form-group col-md-6"><input class="form-control pricing-input" type="text" name="description" placeholder="Description"></div><div class="form-group col-md-1"><button type="button" class="btn btn-danger pricing-input" id="remove-item"><i class="fa fa-minus-circle"></i></button></div></div>';
    var category_row = '<div class="form-row category"><div class="form-group col-md-11"><input class="form-control pricing-input" type="text" name="item-name" placeholder="Category"></div><div class="form-group col-md-1"><button type="button" class="btn btn-danger pricing-input" id="remove-category"><i class="fa fa-minus-circle"></i></button></div></div>'

    $("#add-item").click(function(){
      $("#items-container").append(item_row);
    });

    $("#add-category").click(function(){
      $("#items-container").append(category_row);
    });

    $("#items-container").on('click','#remove-item',function(){
      $(this).closest('.item').remove();
    });

    $("#items-container").on('click','#remove-category',function(){
      $(this).closest('.category').remove();
    });

  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
    
    // Toggle the side navigation when window is resized below 480px
    if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
      $("body").addClass("sidebar-toggled");
      $(".sidebar").addClass("toggled");
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery); // End of use strict
