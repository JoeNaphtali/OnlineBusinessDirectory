$(document).ready(function() {
  
    $("#register-link").on("click", function(){
        $("#loginModal").modal("toggle");
        $("#registrationModal").modal("show");
    });

    $("#login-link").on("click", function(){
        $("#registrationModal").modal("toggle");
        $("#loginModal").modal("show");
    });

});