$(document).ready(function(){
    // Removing The save button from the user Form
    $("#SaveDoctorButt").hide();
    // Adding some Css to the user form
    $(".userForm").addClass("w-50");
    /* Creating A function that will execute an animation each time the user
     clicks on the next butt and calling back a function after the animation */
    $("#nextButt").click(function() {
          $( ".userForm" ).animate({
            opacity: "-0.25"
        }, 500, function() {
            // COde to be run after the animation finishies
        $("#bullet1").removeClass("greenBullet");    
        $("#bullet2").addClass("greenBullet");
        $(".userForm").hide();
        $(".medecinForm").css('opacity','1').show(200);
        $("#SaveDoctorButt").show();
        $("#nextButt").hide();
        $("#prevButt").show();
        });             
    });
    // Same thing With the previous button
    $("#prevButt").click(function() {
        $( ".medecinForm" ).animate({
        opacity: "-0.25"
    }, 500, function() {
        // COde to be run after the animation finishies
    $("#bullet2").removeClass("greenBullet");    
    $("#bullet1").addClass("greenBullet");
    $(".medecinForm").hide();
    $(".userForm").css('opacity','1').show(200);
    $("#SaveDoctorButt").hide();
    $("#prevButt").hide();
    $("#nextButt").show();
    });
    });
    
});